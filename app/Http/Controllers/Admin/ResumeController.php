<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Resume;
use App\Models\About;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\Project;
use App\Models\Certification;
use App\Models\Award;
use App\Models\Activity;
use App\Services\GroqService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Smalot\PdfParser\Parser as PdfParser;

class ResumeController extends AdminController
{
    protected $aiService;

    public function __construct(GroqService $aiService)
    {
        $this->aiService = $aiService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resumes = Resume::latest()->paginate(10);
        return view('admin.resumes.index', compact('resumes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.resumes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate either file or text input
        $request->validate([
            'resume' => 'nullable|mimes:pdf,doc,docx,txt|max:10240',
            'resume_text' => 'nullable|string|min:100',
        ]);

        // Check that at least one input method is provided
        if (!$request->hasFile('resume') && !$request->filled('resume_text')) {
            return back()->with('error', 'Please either upload a file or paste your resume text.');
        }

        try {
            $filename = '';
            $filePath = '';
            $resumeText = '';

            // Handle file upload
            if ($request->hasFile('resume')) {
                $file = $request->file('resume');
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('resumes', $filename, 'public');

                // Extract text from file
                $resumeText = $this->extractTextFromFile(storage_path('app/public/' . $filePath));
            } 
            // Handle text input
            elseif ($request->filled('resume_text')) {
                $resumeText = $request->input('resume_text');
                $filename = 'text_resume_' . time() . '.txt';
                
                // Save text as file for record keeping
                Storage::disk('public')->put('resumes/' . $filename, $resumeText);
                $filePath = 'resumes/' . $filename;
            }

            // Create resume record
            $resume = Resume::create([
                'filename' => $filename,
                'file_path' => $filePath,
                'is_active' => false
            ]);

            return redirect()->route('admin.resumes.show', $resume->id)
                ->with('success', 'Resume uploaded successfully! Click "Parse with AI" to extract data.');

        } catch (\Exception $e) {
            \Log::error('Resume upload error: ' . $e->getMessage());
            return back()->with('error', 'Error uploading resume: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $resume = Resume::findOrFail($id);
        return view('admin.resumes.show', compact('resume'));
    }

    /**
     * Parse resume using Groq AI
     */
    public function parse(string $id)
    {
        try {
            $resume = Resume::findOrFail($id);
            
            // Extract text from file
            $resumeText = $this->extractTextFromFile(storage_path('app/public/' . $resume->file_path));

            if (empty(trim($resumeText))) {
                return back()->with('error', 'Could not extract text from the resume file. The PDF appears to be image-based (scanned). Please use a text-based PDF or try uploading a .txt file with your resume content.');
            }

            // Parse with Groq AI
            $parsedData = $this->aiService->parseResume($resumeText);

            // Update resume with parsed data
            $resume->update([
                'parsed_data' => $parsedData,
                'parsed_at' => now()
            ]);

            return redirect()->route('admin.resumes.show', $id)
                ->with('success', 'Resume parsed successfully with Groq AI! Review the data below and click "Apply to Portfolio" to update your portfolio.');

        } catch (\Exception $e) {
            \Log::error('Resume parsing error: ' . $e->getMessage());
            return back()->with('error', 'Failed to parse resume: ' . $e->getMessage() . '. Please check your API connection and try again.');
        }
    }

    /**
     * Apply parsed data to portfolio
     */
    public function apply(string $id)
    {
        try {
            $resume = Resume::findOrFail($id);
            
            if (!$resume->parsed_data) {
                return back()->with('error', 'Please parse the resume first.');
            }

            DB::beginTransaction();

            // Clear existing data to prevent duplicates (delete instead of truncate for foreign keys)
            Skill::query()->delete();
            SkillCategory::query()->delete();
            Experience::query()->delete();
            Education::query()->delete();
            Project::query()->delete();
            Certification::query()->delete();
            Award::query()->delete();
            Activity::query()->delete();

            $data = $resume->parsed_data;

            // Update About section
            if (isset($data['personal_info'])) {
                $personalInfo = $data['personal_info'];
                $stats = $data['statistics'] ?? [];
                
                // Combine bio and summary
                $bio = $personalInfo['bio'] ?? '';
                if (!empty($personalInfo['summary'])) {
                    $bio .= "\n\n" . $personalInfo['summary'];
                }
                
                About::updateOrCreate(
                    ['id' => 1],
                    [
                        'name' => $personalInfo['name'] ?? '',
                        'title' => $personalInfo['title'] ?? '',
                        'bio' => trim($bio),
                        'email' => $personalInfo['email'] ?? '',
                        'phone' => $personalInfo['phone'] ?? '',
                        'address' => $personalInfo['address'] ?? $personalInfo['location'] ?? '',
                        'years_experience' => $stats['years_experience'] ?? 0,
                        'projects_completed' => $stats['projects_completed'] ?? 0,
                        'clients_served' => $stats['clients_served'] ?? 0,
                        'awards_won' => $stats['awards_won'] ?? 0,
                        'cv_file' => $resume->file_path,
                        'github_url' => $personalInfo['github'] ?? '',
                        'linkedin_url' => $personalInfo['linkedin'] ?? '',
                        'website_url' => $personalInfo['website'] ?? ''
                    ]
                );
            }

            // Add Experiences
            if (isset($data['experiences']) && is_array($data['experiences'])) {
                foreach ($data['experiences'] as $index => $exp) {
                    Experience::create([
                        'position' => $exp['job_title'] ?? $exp['position'] ?? '',
                        'company' => $exp['company'] ?? '',
                        'location' => $exp['location'] ?? '',
                        'start_date' => $exp['start_date'] ?? now(),
                        'end_date' => $exp['end_date'] ?? null,
                        'is_current' => $exp['is_current'] ?? false,
                        'description' => $exp['description'] ?? '',
                        'responsibilities' => $exp['responsibilities'] ?? '',
                        'achievements' => $exp['achievements'] ?? '',
                        'order' => $index
                    ]);
                }
            }

            // Add Education
            if (isset($data['education']) && is_array($data['education'])) {
                foreach ($data['education'] as $index => $edu) {
                    Education::create([
                        'degree' => $edu['degree'] ?? '',
                        'institution' => $edu['institution'] ?? '',
                        'location' => $edu['location'] ?? '',
                        'start_date' => $edu['start_date'] ?? null,
                        'end_date' => $edu['end_date'] ?? null,
                        'grade' => $edu['grade'] ?? '',
                        'description' => $edu['description'] ?? '',
                        'order' => $index
                    ]);
                }
            }

            // Add Skills - group by category
            if (isset($data['skills']) && is_array($data['skills'])) {
                $categoriesMap = [];
                $skillsByCategory = [];
                
                // Group skills by category
                foreach ($data['skills'] as $skill) {
                    $categoryName = $skill['category'] ?? 'General';
                    if (!isset($skillsByCategory[$categoryName])) {
                        $skillsByCategory[$categoryName] = [];
                    }
                    $skillsByCategory[$categoryName][] = $skill;
                }
                
                // Create categories and skills
                $categoryIndex = 0;
                foreach ($skillsByCategory as $categoryName => $skills) {
                    $category = SkillCategory::create([
                        'name' => $categoryName,
                        'order' => $categoryIndex++
                    ]);
                    
                    foreach ($skills as $skillIndex => $skillData) {
                        Skill::create([
                            'skill_category_id' => $category->id,
                            'name' => $skillData['name'] ?? '',
                            'proficiency' => $skillData['proficiency'] ?? 80,
                            'years_experience' => $skillData['years_experience'] ?? 1,
                            'icon' => 'fas fa-check',
                            'order' => $skillIndex
                        ]);
                    }
                }
            }

            // Add Projects
            if (isset($data['projects']) && is_array($data['projects'])) {
                foreach ($data['projects'] as $index => $proj) {
                    Project::create([
                        'title' => $proj['title'] ?? '',
                        'description' => $proj['description'] ?? '',
                        'demo_url' => $proj['demo_url'] ?? $proj['url'] ?? '',
                        'github_url' => $proj['github_url'] ?? '',
                        'technologies' => is_array($proj['technologies'] ?? null) ? json_encode($proj['technologies']) : json_encode([]),
                        'featured' => $proj['featured'] ?? false,
                        'order' => $index
                    ]);
                }
            }

            // Add Certifications
            if (isset($data['certifications']) && is_array($data['certifications'])) {
                foreach ($data['certifications'] as $index => $cert) {
                    Certification::create([
                        'name' => $cert['name'] ?? '',
                        'organization' => $cert['issuing_organization'] ?? $cert['organization'] ?? 'N/A',
                        'issue_date' => $cert['issue_date'] ?? now(),
                        'expiry_date' => $cert['expiry_date'] ?? null,
                        'credential_id' => $cert['credential_id'] ?? '',
                        'credential_url' => $cert['credential_url'] ?? '',
                        'order' => $index
                    ]);
                }
            }

            // Add Awards
            if (isset($data['awards']) && is_array($data['awards'])) {
                foreach ($data['awards'] as $index => $award) {
                    Award::create([
                        'title' => $award['title'] ?? '',
                        'organization' => $award['organization'] ?? '',
                        'date' => $award['date'] ?? now(),
                        'description' => $award['description'] ?? '',
                        'order' => $index
                    ]);
                }
            }

            // Add Activities
            if (isset($data['activities']) && is_array($data['activities'])) {
                foreach ($data['activities'] as $index => $activity) {
                    Activity::create([
                        'title' => $activity['title'] ?? '',
                        'organization' => $activity['organization'] ?? '',
                        'start_date' => $activity['start_date'] ?? null,
                        'end_date' => $activity['end_date'] ?? null,
                        'is_current' => $activity['is_current'] ?? false,
                        'description' => $activity['description'] ?? '',
                        'order' => $index
                    ]);
                }
            }

            // Mark resume as active
            Resume::where('id', '!=', $id)->update(['is_active' => false]);
            $resume->update(['is_active' => true]);

            DB::commit();

            return redirect()->route('admin.dashboard')
                ->with('success', 'Resume data applied successfully! Your portfolio has been updated.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error applying resume data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $resume = Resume::findOrFail($id);
            
            // Delete file
            if (Storage::disk('public')->exists($resume->file_path)) {
                Storage::disk('public')->delete($resume->file_path);
            }

            $resume->delete();

            return redirect()->route('admin.resumes.index')
                ->with('success', 'Resume deleted successfully!');

        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting resume: ' . $e->getMessage());
        }
    }

    /**
     * Extract text from uploaded file
     */
    protected function extractTextFromFile(string $filePath): string
    {
        if (!file_exists($filePath)) {
            throw new \Exception("File not found: {$filePath}");
        }

        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        if ($extension === 'pdf') {
            try {
                $parser = new PdfParser();
                $pdf = $parser->parseFile($filePath);
                $text = $pdf->getText();
                
                if (empty(trim($text))) {
                    throw new \Exception("PDF appears to be empty or is an image-based PDF");
                }
                
                return $text;
            } catch (\Exception $e) {
                \Log::error("PDF parsing error: " . $e->getMessage());
                throw new \Exception("Failed to extract text from PDF: " . $e->getMessage());
            }
        } elseif (in_array($extension, ['txt', 'text'])) {
            $text = file_get_contents($filePath);
            if (empty(trim($text))) {
                throw new \Exception("Text file is empty");
            }
            return $text;
        } elseif (in_array($extension, ['doc', 'docx'])) {
            // For .doc/.docx files, try to read as text (limited support)
            $text = file_get_contents($filePath);
            if (empty(trim($text))) {
                throw new \Exception("Document file could not be read or is empty");
            }
            return $text;
        }

        throw new \Exception("Unsupported file format: {$extension}. Please upload a PDF or TXT file.");
    }
}

