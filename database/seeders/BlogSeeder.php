<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogCategory;
use App\Models\Blog;
use App\Models\BlogComment;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Categories
        $categories = [
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'description' => 'Latest tech trends, programming tips, and software development',
                'color' => 'blue',
                'icon' => 'fas fa-laptop-code',
                'order' => 1,
                'is_active' => true
            ],
            [
                'name' => 'Lifestyle',
                'slug' => 'lifestyle',
                'description' => 'Daily life hacks, productivity tips, and personal growth',
                'color' => 'pink',
                'icon' => 'fas fa-heart',
                'order' => 2,
                'is_active' => true
            ],
            [
                'name' => 'Travel',
                'slug' => 'travel',
                'description' => 'Travel guides, adventures, and destination reviews',
                'color' => 'green',
                'icon' => 'fas fa-plane',
                'order' => 3,
                'is_active' => true
            ],
            [
                'name' => 'Food & Recipes',
                'slug' => 'food-recipes',
                'description' => 'Delicious recipes, cooking tips, and food reviews',
                'color' => 'orange',
                'icon' => 'fas fa-utensils',
                'order' => 4,
                'is_active' => true
            ],
            [
                'name' => 'Fitness',
                'slug' => 'fitness',
                'description' => 'Workout routines, health tips, and fitness motivation',
                'color' => 'red',
                'icon' => 'fas fa-dumbbell',
                'order' => 5,
                'is_active' => true
            ]
        ];

        foreach ($categories as $category) {
            BlogCategory::create($category);
        }

        // Get created categories
        $techCategory = BlogCategory::where('slug', 'technology')->first();
        $lifestyleCategory = BlogCategory::where('slug', 'lifestyle')->first();
        $travelCategory = BlogCategory::where('slug', 'travel')->first();

        // Create Blog Posts
        $blogs = [
            [
                'category_id' => $techCategory->id,
                'title' => '10 Essential Web Development Tips for 2026',
                'slug' => '10-essential-web-development-tips-for-2026',
                'excerpt' => 'Master modern web development with these proven strategies and best practices that will elevate your coding skills.',
                'content' => '<h2>Introduction to Modern Web Development</h2><p>The web development landscape is constantly evolving. In 2026, developers need to stay ahead of the curve with cutting-edge technologies and methodologies.</p><h3>1. Embrace Component-Based Architecture</h3><p>Component-based frameworks like React, Vue, and Angular have revolutionized how we build web applications. Breaking down your UI into reusable components makes your code more maintainable and scalable.</p><h3>2. Master Responsive Design</h3><p>With mobile traffic dominating the web, responsive design is no longer optional. Use CSS Grid and Flexbox to create fluid layouts that work seamlessly across all devices.</p><h3>3. Optimize Performance</h3><p>Page speed directly impacts user experience and SEO. Implement lazy loading, code splitting, and asset optimization to ensure blazing-fast load times.</p><h3>4. Focus on Accessibility</h3><p>Building inclusive web applications benefits everyone. Follow WCAG guidelines and use semantic HTML to make your sites accessible to all users.</p><h3>5. Leverage Modern CSS Features</h3><p>CSS has evolved tremendously. Utilize custom properties, container queries, and modern layout techniques to create beautiful, maintainable styles.</p><p><strong>Conclusion:</strong> By implementing these tips, you\'ll be well-equipped to tackle modern web development challenges and build exceptional user experiences.</p>',
                'author_name' => 'Javed',
                'tags' => 'web development, programming, tips, 2026',
                'social_link' => null,
                'views' => 245,
                'likes_count' => 42,
                'is_published' => true,
                'is_featured' => true,
                'published_at' => now()->subDays(2)
            ],
            [
                'category_id' => $lifestyleCategory->id,
                'title' => '5 Daily Habits That Will Transform Your Productivity',
                'slug' => '5-daily-habits-transform-productivity',
                'excerpt' => 'Discover simple yet powerful daily habits that successful people use to maximize their productivity and achieve their goals.',
                'content' => '<h2>The Power of Daily Habits</h2><p>Success is built on consistent daily actions. These five habits can dramatically improve your productivity and overall well-being.</p><h3>1. Start Your Day with a Morning Routine</h3><p>The first hour of your day sets the tone for everything that follows. Create a morning routine that energizes you and prepares you for success.</p><ul><li>Wake up at the same time every day</li><li>Exercise or stretch for 15-20 minutes</li><li>Eat a healthy breakfast</li><li>Review your goals and priorities</li></ul><h3>2. Practice Time Blocking</h3><p>Instead of multitasking, dedicate specific time blocks to different activities. This focused approach helps you accomplish more in less time.</p><h3>3. Take Regular Breaks</h3><p>The Pomodoro Technique (25 minutes of work, 5-minute breaks) can significantly boost your focus and prevent burnout.</p><h3>4. Limit Decision Fatigue</h3><p>Simplify your daily choices by establishing routines for recurring decisions. Steve Jobs famously wore the same outfit every day to preserve mental energy for important decisions.</p><h3>5. Reflect and Plan</h3><p>Spend 10 minutes each evening reviewing your day and planning tomorrow. This practice provides clarity and reduces morning stress.</p><p><em>Start implementing these habits today and watch your productivity soar!</em></p>',
                'author_name' => 'Javed',
                'tags' => 'productivity, habits, lifestyle, self-improvement',
                'social_link' => null,
                'views' => 189,
                'likes_count' => 67,
                'is_published' => true,
                'is_featured' => true,
                'published_at' => now()->subDays(5)
            ],
            [
                'category_id' => $travelCategory->id,
                'title' => 'Hidden Gems: 7 Underrated Travel Destinations in Asia',
                'slug' => 'hidden-gems-underrated-travel-destinations-asia',
                'excerpt' => 'Skip the crowded tourist traps and discover these breathtaking, lesser-known destinations across Asia.',
                'content' => '<h2>Discover Asia\'s Best-Kept Secrets</h2><p>While popular destinations like Tokyo and Bali attract millions of tourists, these hidden gems offer authentic experiences without the crowds.</p><h3>1. Luang Prabang, Laos</h3><p>This UNESCO World Heritage town combines French colonial architecture with traditional Lao temples. The morning alms ceremony is a spiritual experience you won\'t forget.</p><h3>2. Palawan, Philippines</h3><p>Often called the "last frontier" of the Philippines, Palawan boasts crystal-clear waters, limestone cliffs, and untouched beaches that rival any tropical paradise.</p><h3>3. Hoi An, Vietnam</h3><p>This ancient trading port features colorful lanterns, tailor shops, and some of the best street food in Southeast Asia. The monthly Full Moon Festival is magical.</p><h3>4. Siem Reap, Cambodia</h3><p>While Angkor Wat is famous, the surrounding countryside offers authentic village experiences, floating markets, and lesser-known temple complexes.</p><h3>5. Bhutan</h3><p>The land of Gross National Happiness limits tourism to preserve its culture and environment. The result? Pristine nature and authentic Buddhist culture.</p><h3>6. Yakushima, Japan</h3><p>This mystical island inspired Studio Ghibli\'s Princess Mononoke. Ancient cedar forests and moss-covered landscapes create an otherworldly atmosphere.</p><h3>7. Raja Ampat, Indonesia</h3><p>Considered the heart of marine biodiversity, this archipelago offers world-class diving and some of the most pristine coral reefs on Earth.</p><p><strong>Pro Tip:</strong> Visit during shoulder season (April-May or September-October) for better weather and fewer tourists.</p>',
                'author_name' => 'Javed',
                'tags' => 'travel, asia, destinations, tourism, adventure',
                'social_link' => null,
                'views' => 312,
                'likes_count' => 98,
                'is_published' => true,
                'is_featured' => true,
                'published_at' => now()->subDays(7)
            ],
            [
                'category_id' => $techCategory->id,
                'title' => 'Getting Started with Laravel 12: A Complete Guide',
                'slug' => 'getting-started-laravel-12-guide',
                'excerpt' => 'Learn the fundamentals of Laravel 12 and build your first web application with this comprehensive beginner-friendly guide.',
                'content' => '<h2>Why Laravel?</h2><p>Laravel is the most popular PHP framework, known for its elegant syntax and powerful features that make web development enjoyable and efficient.</p><h3>Installation</h3><p>First, ensure you have PHP 8.3 or higher and Composer installed. Then run:</p><pre><code>composer create-project laravel/laravel my-app</code></pre><h3>Key Features</h3><ul><li><strong>Eloquent ORM:</strong> Beautiful database interactions</li><li><strong>Blade Templates:</strong> Powerful templating engine</li><li><strong>Routing:</strong> Simple and expressive routing system</li><li><strong>Middleware:</strong> HTTP request filtering</li><li><strong>Authentication:</strong> Built-in user authentication</li></ul><h3>Your First Route</h3><p>Open <code>routes/web.php</code> and add:</p><pre><code>Route::get(\'/hello\', function () {\n    return view(\'hello\');\n});</code></pre><p>Laravel makes building modern web applications a breeze. Start your journey today!</p>',
                'author_name' => 'Javed',
                'tags' => 'laravel, php, web development, tutorial',
                'social_link' => null,
                'views' => 156,
                'likes_count' => 34,
                'is_published' => true,
                'is_featured' => false,
                'published_at' => now()->subDays(10)
            ],
            [
                'category_id' => $lifestyleCategory->id,
                'title' => 'Minimalism: Living More with Less',
                'slug' => 'minimalism-living-more-with-less',
                'excerpt' => 'Embrace minimalism to reduce stress, increase focus, and find more meaning in your life.',
                'content' => '<h2>The Minimalist Philosophy</h2><p>Minimalism isn\'t about deprivation—it\'s about intentionality. By removing excess, we make room for what truly matters.</p><h3>Benefits of Minimalism</h3><ul><li>Reduced stress and anxiety</li><li>More time for meaningful activities</li><li>Financial freedom</li><li>Environmental sustainability</li><li>Improved mental clarity</li></ul><h3>Getting Started</h3><p>Start small. Declutter one drawer, one closet, one room at a time. Ask yourself: "Does this add value to my life?"</p><p>Remember, minimalism looks different for everyone. Find what works for you.</p>',
                'author_name' => 'Javed',
                'tags' => 'minimalism, lifestyle, declutter, simplicity',
                'social_link' => null,
                'views' => 203,
                'likes_count' => 56,
                'is_published' => true,
                'is_featured' => false,
                'published_at' => now()->subDays(12)
            ]
        ];

        foreach ($blogs as $blog) {
            $createdBlog = Blog::create($blog);

            // Add some sample comments to the first blog
            if ($createdBlog->id === 1) {
                BlogComment::create([
                    'blog_id' => $createdBlog->id,
                    'name' => 'Sarah Johnson',
                    'email' => 'sarah@example.com',
                    'comment' => 'Great article! These tips are exactly what I needed. The component-based architecture section was particularly helpful.',
                    'is_approved' => true
                ]);

                BlogComment::create([
                    'blog_id' => $createdBlog->id,
                    'name' => 'Mike Chen',
                    'email' => 'mike@example.com',
                    'comment' => 'Thanks for sharing! Could you elaborate more on the performance optimization techniques?',
                    'is_approved' => true
                ]);
            }
        }

        $this->command->info('Blog seeder completed successfully!');
        $this->command->info('Created: ' . BlogCategory::count() . ' categories');
        $this->command->info('Created: ' . Blog::count() . ' blog posts');
        $this->command->info('Created: ' . BlogComment::count() . ' comments');
    }
}

