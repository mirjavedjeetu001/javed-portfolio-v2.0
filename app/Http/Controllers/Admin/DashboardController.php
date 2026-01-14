<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\About;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Education;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\Certification;
use App\Models\Award;
use App\Models\Activity;
use App\Models\Blog;
use App\Models\ContactMessage;
use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends AdminController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index()
    {
        $stats = [
            'experiences' => Experience::count(),
            'projects' => Project::count(),
            'skills' => Skill::count(),
            'education' => Education::count(),
            'blogs' => Blog::count(),
            'contact_messages' => ContactMessage::where('is_read', false)->count(),
        ];

        $about = About::first();
        $recentResumes = Resume::latest()->take(5)->get();
        $recentMessages = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'about', 'recentResumes', 'recentMessages'));
    }

    public function resetData()
    {
        try {
            DB::beginTransaction();

            // Clear all portfolio data (delete instead of truncate to avoid foreign key issues)
            Skill::query()->delete();
            SkillCategory::query()->delete();
            Experience::query()->delete();
            Education::query()->delete();
            Project::query()->delete();
            Certification::query()->delete();
            Award::query()->delete();
            Activity::query()->delete();

            DB::commit();

            return redirect()->route('admin.dashboard')
                ->with('success', 'All portfolio data has been reset successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error resetting data: ' . $e->getMessage());
        }
    }

    public function resetBlogData()
    {
        try {
            DB::beginTransaction();

            // Delete blog comments first (foreign key constraint)
            \App\Models\BlogComment::query()->delete();
            
            // Delete blog likes
            \App\Models\BlogLike::query()->delete();
            
            // Delete blogs
            Blog::query()->delete();
            
            // Delete blog categories
            \App\Models\BlogCategory::query()->delete();

            DB::commit();

            return redirect()->route('admin.dashboard')
                ->with('success', 'All blog data (posts, categories, comments, likes) has been reset successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error resetting blog data: ' . $e->getMessage());
        }
    }
}
