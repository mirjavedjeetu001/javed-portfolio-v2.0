<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GroqService
{
    protected $apiKey;
    protected $apiUrl = 'https://api.groq.com/openai/v1/chat/completions';

    public function __construct()
    {
        $this->apiKey = env('GROQ_API_KEY');
    }

    /**
     * Parse resume PDF/text and extract structured data
     */
    public function parseResume(string $resumeText): array
    {
        $prompt = $this->buildResumeParsingPrompt($resumeText);
        
        try {
            $response = Http::timeout(120)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                ])
                ->post($this->apiUrl, [
                    'model' => 'llama-3.3-70b-versatile',
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => 'You are an expert resume parser. Extract structured data from resumes and return ONLY valid JSON without any markdown formatting or code blocks. Start with { and end with }.'
                        ],
                        [
                            'role' => 'user',
                            'content' => $prompt
                        ]
                    ],
                    'temperature' => 0.1,
                    'max_tokens' => 16000,
                    'response_format' => ['type' => 'json_object'],
                ]);

            if ($response->successful()) {
                $result = $response->json();
                
                if (!isset($result['choices'][0]['message']['content'])) {
                    Log::error('Groq API Response Missing Content: ' . json_encode($result));
                    throw new \Exception('Invalid response structure from Groq API');
                }
                
                $text = $result['choices'][0]['message']['content'];
                
                // Log raw response for debugging
                Log::info('Raw Groq Response Length: ' . strlen($text));
                Log::info('Raw Response Preview: ' . substr($text, 0, 200));
                
                // Extract JSON from markdown code blocks if present
                $text = $this->extractJson($text);
                
                Log::info('Cleaned JSON Length: ' . strlen($text));
                Log::info('Cleaned JSON Preview: ' . substr($text, 0, 200));
                
                $decoded = json_decode($text, true);
                
                if (json_last_error() !== JSON_ERROR_NONE) {
                    Log::error('JSON Decode Error: ' . json_last_error_msg());
                    Log::error('JSON Content (first 2000 chars): ' . substr($text, 0, 2000));
                    Log::error('JSON Content (last 500 chars): ' . substr($text, -500));
                    throw new \Exception('Failed to parse JSON response from AI. Please check your API connection and try again.');
                }
                
                return $decoded;
            }

            $errorBody = $response->body();
            Log::error('Groq API Error (Status: ' . $response->status() . '): ' . $errorBody);
            throw new \Exception('Groq API request failed: ' . $response->status());

        } catch (\Exception $e) {
            Log::error('Groq Service Exception: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Build prompt for resume parsing
     */
    protected function buildResumeParsingPrompt(string $resumeText): string
    {
        return <<<PROMPT
You are an expert resume parser. Carefully analyze the following resume and extract ALL information into a structured JSON format.

Resume Text:
$resumeText

IMPORTANT INSTRUCTIONS:
1. Extract ALL experiences, education, skills, projects, certifications, and awards mentioned
2. Parse dates carefully - convert to YYYY-MM-DD format (use YYYY-MM-01 if only month/year given)
3. For skills, assign realistic proficiency (70-95) based on experience level and context
4. Extract ALL projects with their descriptions and technologies
5. Include certifications, awards, and activities
6. Extract contact information accurately including phone, email, GitHub, LinkedIn, website
7. Parse location and personal information
8. Group skills by categories (Programming Languages, Frameworks, Tools, Soft Skills, etc.)

Return ONLY valid JSON (no markdown, no code blocks) with this EXACT structure:

{
  "personal_info": {
    "name": "Full Name",
    "title": "Professional Title/Current Position",
    "email": "email@example.com",
    "phone": "+880-XXXXXXXXXX",
    "location": "City, Country",
    "website": "personal-website-url",
    "linkedin": "linkedin-url",
    "github": "github-url",
    "bio": "Professional summary/about text",
    "summary": "Career summary paragraph",
    "address": "Full address if available",
    "date_of_birth": "DD Month YYYY",
    "blood_group": "Blood type if mentioned"
  },
  "statistics": {
    "years_experience": 5,
    "projects_completed": 15,
    "clients_served": 10,
    "awards_won": 2
  },
  "experiences": [
    {
      "job_title": "Exact job title",
      "company": "Company name",
      "location": "City, Country",
      "start_date": "2020-01-01",
      "end_date": "2025-12-31",
      "is_current": true,
      "description": "Main role description",
      "responsibilities": "• Bullet point 1\n• Bullet point 2\n• Bullet point 3",
      "achievements": "Key achievements from this role"
    }
  ],
  "skills": [
    {
      "category": "Programming Languages",
      "name": "PHP",
      "proficiency": 90,
      "years_experience": 5
    },
    {
      "category": "Frameworks & Libraries",
      "name": "Laravel",
      "proficiency": 90,
      "years_experience": 4
    },
    {
      "category": "Frontend Technologies",
      "name": "React JS",
      "proficiency": 85,
      "years_experience": 3
    },
    {
      "category": "Tools & Technologies",
      "name": "Git",
      "proficiency": 85,
      "years_experience": 5
    },
    {
      "category": "Soft Skills",
      "name": "Team Leadership",
      "proficiency": 85,
      "years_experience": 3
    }
  ],
  "education": [
    {
      "degree": "Masters/Bachelor/etc",
      "field_of_study": "Computer Science",
      "institution": "University Name",
      "location": "City, Country",
      "start_date": "2018-09-01",
      "end_date": "2023-09-01",
      "grade": "CGPA or GPA",
      "description": "Relevant coursework or achievements"
    }
  ],
  "certifications": [
    {
      "name": "Certification Name",
      "issuing_organization": "Organization",
      "issue_date": "2025-03-01",
      "expiry_date": null,
      "credential_id": "ID if available",
      "credential_url": "URL if available"
    }
  ],
  "projects": [
    {
      "title": "Project Name",
      "description": "Detailed project description with outcomes",
      "technologies": ["React", "Node.js", "MySQL"],
      "demo_url": "https://project-url.com",
      "github_url": "https://github.com/username/repo",
      "featured": true
    }
  ],
  "awards": [
    {
      "title": "Award Name",
      "organization": "Awarding Organization",
      "date": "2024-11-16",
      "description": "Award description"
    }
  ],
  "activities": [
    {
      "title": "Activity/Volunteer Role",
      "organization": "Organization Name",
      "start_date": "2012-01-01",
      "end_date": null,
      "is_current": true,
      "description": "Description of activity"
    }
  ],
  "languages": [
    {
      "name": "English",
      "proficiency": "Fluent/Native/Professional"
    }
  ],
  "social_links": [
    {
      "platform": "LinkedIn",
      "url": "https://linkedin.com/in/username",
      "icon": "fab fa-linkedin"
    },
    {
      "platform": "GitHub",
      "url": "https://github.com/username",
      "icon": "fab fa-github"
    }
  ],
  "references": [
    {
      "name": "Reference Name",
      "designation": "Job Title",
      "organization": "Company",
      "phone": "+880-XXXXXXXXXX",
      "relationship": "Professional relationship"
    }
  ]
}

CRITICAL RULES:
- Extract EVERY experience entry, don't skip any
- Extract EVERY education entry with exact grades/GPA
- Extract EVERY project mentioned
- Extract ALL skills mentioned, group them by meaningful categories
- Extract ALL certifications and awards
- Parse dates accurately: MM/YYYY or YYYY -> convert to YYYY-MM-01
- For is_current: true if "Current", "Present", or end date not mentioned
- Estimate proficiency based on years of experience and context
- Return ONLY the JSON object, nothing else
PROMPT;
    }

    /**
     * Extract JSON from markdown code blocks and clean response
     */
    protected function extractJson(string $text): string
    {
        // Remove markdown code blocks
        $text = preg_replace('/```json\s*/is', '', $text);
        $text = preg_replace('/```\s*/is', '', $text);
        
        // Find the first { and last }
        $start = strpos($text, '{');
        $end = strrpos($text, '}');
        
        if ($start !== false && $end !== false && $end > $start) {
            $text = substr($text, $start, $end - $start + 1);
        }
        
        // Clean up any BOM or special characters
        $text = preg_replace('/[\x00-\x1F\x7F]/u', '', $text);
        
        return trim($text);
    }
}
