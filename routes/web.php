<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\CertificationController;
use App\Http\Controllers\Admin\AwardController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\ResumeController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ContactMessageController;

// Authentication Routes (Registration disabled - only super admin can create users)
Auth::routes(['register' => false]);
// Frontend Routes
Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/download-resume', [PortfolioController::class, 'downloadResume'])->name('download.resume');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/reset-data', [DashboardController::class, 'resetData'])->name('reset-data');
    
    // About Management
    Route::resource('about', AboutController::class)->except(['show']);
    
    // Experience Management
    Route::resource('experiences', ExperienceController::class);
    
    // Education Management
    Route::resource('education', EducationController::class);
    
    // Skills Management
    Route::resource('skills', SkillController::class);
    Route::post('skills/reorder', [SkillController::class, 'reorder'])->name('skills.reorder');
    
    // Projects Management
    Route::post('projects/{project}/toggle-featured', [ProjectController::class, 'toggleFeatured'])->name('projects.toggle-featured');
    Route::resource('projects', ProjectController::class);
    
    // Certifications Management
    Route::resource('certifications', CertificationController::class);
    
    // Awards Management
    Route::resource('awards', AwardController::class);
    
    // Activities Management
    Route::resource('activities', ActivityController::class);
    
    // Resume Management (with AI)
    Route::resource('resumes', ResumeController::class);
    Route::post('resumes/{id}/parse', [ResumeController::class, 'parse'])->name('resumes.parse');
    Route::post('resumes/{id}/apply', [ResumeController::class, 'apply'])->name('resumes.apply');
    
    // Theme Settings
    Route::get('theme', [ThemeController::class, 'index'])->name('theme.index');
    Route::post('theme', [ThemeController::class, 'update'])->name('theme.update');
    
    // General Settings
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    
    // Menu Management
    Route::get('menu', [\App\Http\Controllers\Admin\MenuController::class, 'index'])->name('menu.index');
    Route::post('menu', [\App\Http\Controllers\Admin\MenuController::class, 'store'])->name('menu.store');
    Route::put('menu/{menu}', [\App\Http\Controllers\Admin\MenuController::class, 'update'])->name('menu.update');
    Route::delete('menu/{menu}', [\App\Http\Controllers\Admin\MenuController::class, 'destroy'])->name('menu.destroy');
    Route::patch('menu/{menu}/toggle', [\App\Http\Controllers\Admin\MenuController::class, 'toggleVisibility'])->name('menu.toggle');
    
    // Section Visibility
    Route::get('sections', [\App\Http\Controllers\Admin\SectionVisibilityController::class, 'index'])->name('sections.index');
    Route::patch('sections/{section}/toggle', [\App\Http\Controllers\Admin\SectionVisibilityController::class, 'toggleVisibility'])->name('sections.toggle');
    
    // Contact Messages
    Route::get('messages', [ContactMessageController::class, 'index'])->name('messages.index');
    Route::get('messages/{message}', [ContactMessageController::class, 'show'])->name('messages.show');
    Route::delete('messages/{message}', [ContactMessageController::class, 'destroy'])->name('messages.destroy');
    Route::patch('messages/{message}/read', [ContactMessageController::class, 'markAsRead'])->name('messages.mark-read');
    Route::patch('messages/{message}/unread', [ContactMessageController::class, 'markAsUnread'])->name('messages.mark-unread');
    
    // User Management (Super Admin Only)
    Route::middleware('super_admin')->prefix('users')->name('users.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('destroy');
    });
});
    
