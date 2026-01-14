<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Experience;
use App\Models\SkillCategory;
use App\Models\Project;
use App\Models\Education;
use App\Models\Certification;
use App\Models\Award;
use App\Models\Activity;
use App\Models\Entrepreneurship;
use App\Models\Blog;
use App\Models\SocialLink;
use App\Models\ThemeSetting;
use App\Models\Setting;
use App\Models\MenuItem;
use App\Models\SectionVisibility;

class PortfolioController extends Controller
{
    public function index()
    {
        $about = About::first();
        $experiences = Experience::orderBy('order')->get();
        $skillCategories = SkillCategory::with('skills')->orderBy('order')->get();
        $projects = Project::orderBy('order')->get();
        $featuredProjects = Project::where('is_featured', true)->orderBy('order')->take(3)->get();
        $education = Education::orderBy('order')->get();
        $certifications = Certification::orderBy('order')->get();
        $awards = Award::orderBy('date', 'desc')->get();
        $activities = Activity::orderBy('start_date', 'desc')->get();
        $entrepreneurships = Entrepreneurship::orderBy('order')->get();
        $latestBlogs = Blog::with('category')->where('is_published', true)->latest('published_at')->take(3)->get();
        $socialLinks = SocialLink::where('is_active', true)->orderBy('order')->get();
        $theme = ThemeSetting::first();
        $settings = Setting::pluck('value', 'key');
        $menuItems = MenuItem::where('is_visible', true)->orderBy('order')->get();
        $sectionVisibility = SectionVisibility::pluck('is_visible', 'section_id');

        return view('portfolio.index', compact(
            'about', 'experiences', 'skillCategories', 'projects', 'featuredProjects',
            'education', 'certifications', 'awards', 'activities', 'entrepreneurships',
            'latestBlogs', 'socialLinks', 'theme', 'settings', 'menuItems', 'sectionVisibility'
        ));
    }
    
    public function downloadResume()
    {
        $resumePath = Setting::where('key', 'resume_pdf_path')->value('value');
        
        if (!$resumePath || !\Storage::disk('public')->exists($resumePath)) {
            return back()->with('error', 'Resume file not found. Please contact the administrator.');
        }
        
        $filePath = storage_path('app/public/' . $resumePath);
        $fileName = 'Resume_' . now()->format('Y') . '.pdf';
        
        return response()->download($filePath, $fileName);
    }
}
