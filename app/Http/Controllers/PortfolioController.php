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
use App\Models\BlogPost;
use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use App\Models\SocialLink;
use App\Models\ThemeSetting;
use App\Models\Setting;

class PortfolioController extends Controller
{
    public function index()
    {
        $about = About::first();
        $experiences = Experience::orderBy('order')->get();
        $skillCategories = SkillCategory::with('skills')->orderBy('order')->get();
        $projects = Project::orderBy('order')->get();
        $education = Education::orderBy('order')->get();
        $certifications = Certification::orderBy('order')->get();
        $awards = Award::orderBy('date', 'desc')->get();
        $activities = Activity::orderBy('start_date', 'desc')->get();
        $entrepreneurships = Entrepreneurship::orderBy('order')->get();
        $blogPosts = BlogPost::where('is_published', true)->latest('published_at')->take(6)->get();
        $galleryImages = GalleryImage::with('category')->orderBy('order')->take(12)->get();
        $socialLinks = SocialLink::where('is_active', true)->orderBy('order')->get();
        $theme = ThemeSetting::first();
        $settings = Setting::pluck('value', 'key');

        return view('portfolio.index', compact(
            'about', 'experiences', 'skillCategories', 'projects',
            'education', 'certifications', 'awards', 'activities', 'entrepreneurships',
            'blogPosts', 'galleryImages', 'socialLinks', 'theme', 'settings'
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
