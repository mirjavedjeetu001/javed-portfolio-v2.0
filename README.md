# 🚀 Professional Portfolio CMS

A modern, feature-rich Content Management System (CMS) built with Laravel for creating and managing professional portfolios with an elegant admin panel.

![Laravel](https://img.shields.io/badge/Laravel-12.46.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.3.6-777BB4?style=for-the-badge&logo=php&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

## ✨ Features

### 🎨 Frontend Features
- **Modern Responsive Design** - Beautiful, mobile-first portfolio interface
- **Hero Section** with floating particles animation (enable/disable)
- **Animated Preloader** - Technical rotating circles loader (configurable)
- **Dynamic Sections:**
  - About Me with social media links
  - Experience Timeline
  - Skills with animated progress bars
  - Projects Showcase with lazy loading
  - Education History
  - Certifications & Awards
  - Activities & Achievements
  - Contact Form with scroll fix
- **Back to Top Button** - Smooth scroll navigation
- **Optimized Performance** - Fast project section scrolling with GPU acceleration
- **AOS Animations** - Scroll-triggered animations throughout

### 🔐 Admin Panel Features
- **Premium Tailwind UI** - Modern, gradient-based admin interface
- **Secure Authentication System:**
  - Role-based access (Super Admin, Admin, User)
  - Premium animated login page
  - Protected routes with middleware
- **Complete CRUD Operations:**
  - About Information Management
  - Experience Management
  - Skills & Skill Categories
  - Projects with image uploads
  - Education Records
  - Certifications
  - Awards & Honors
  - Activities
  - Resume Content Management
- **Advanced Features:**
  - **PDF Resume Upload** - Upload and manage resume PDF
  - **Contact Messages Management** - View, mark as read/unread, delete
  - **User Management** (Super Admin only) - Create, edit, delete users
  - **Theme Settings** - Customize colors and appearance
  - **General Settings** - Enable/disable animations and features
  - **Section Visibility** - Show/hide portfolio sections
  - **Menu Management** - Customize navigation
- **Dashboard Analytics:**
  - Total counts for all content types
  - Unread messages counter
  - Recent activities
  - Quick access cards

### 🛡️ Security & Architecture
- **Middleware Protection:**
  - Authentication middleware for all admin routes
  - Role-based authorization (Admin & Super Admin)
  - CSRF protection on all forms
- **MVC Architecture** - Clean, maintainable code structure
- **Base Admin Controller** - Centralized authentication handling
- **Input Validation** - Server-side validation on all forms

## 📋 Requirements

- PHP >= 8.3.6
- Composer
- MySQL >= 8.0
- Node.js & NPM (for asset compilation if needed)
- Apache/Nginx web server

## 🚀 Installation

### 1. Clone the Repository
```bash
git clone <your-repository-url>
cd portfolio-project
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio_db
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Database Setup
```bash
# Create database
mysql -u root -p -e "CREATE DATABASE portfolio_db;"

# Run migrations
php artisan migrate

# Seed database with sample data (optional)
php artisan db:seed
```

### 5. Storage Setup
```bash
php artisan storage:link
```

### 6. Create Super Admin Account
```bash
php artisan tinker
```
Then run:
```php
\App\Models\User::create([
    'name' => 'Super Admin',
    'email' => 'admin@admin.com',
    'password' => bcrypt('admin123'),
    'role' => 'super_admin'
]);
exit
```

### 7. Start Development Server
```bash
php artisan serve
```

Visit: `http://127.0.0.1:8000`

## 🔑 Default Credentials

**Super Admin:**
- Email: `admin@admin.com`
- Password: `admin123`

⚠️ **Important:** Change the default password after first login!

## 📁 Project Structure

```
portfolio-project/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/           # Admin panel controllers
│   │   │   │   ├── AdminController.php (Base)
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── AboutController.php
│   │   │   │   ├── ExperienceController.php
│   │   │   │   ├── SkillController.php
│   │   │   │   ├── ProjectController.php
│   │   │   │   ├── EducationController.php
│   │   │   │   ├── CertificationController.php
│   │   │   │   ├── AwardController.php
│   │   │   │   ├── ActivityController.php
│   │   │   │   ├── ResumeController.php
│   │   │   │   ├── ContactMessageController.php
│   │   │   │   ├── UserController.php
│   │   │   │   ├── ThemeController.php
│   │   │   │   └── SettingController.php
│   │   │   ├── Auth/            # Authentication controllers
│   │   │   ├── PortfolioController.php
│   │   │   └── ContactController.php
│   │   └── Middleware/
│   │       ├── Authenticate.php
│   │       ├── AdminMiddleware.php
│   │       └── SuperAdminMiddleware.php
│   └── Models/                  # Eloquent models
├── database/
│   └── migrations/              # Database migrations
├── public/
│   └── storage/                 # Uploaded files (images, PDFs)
├── resources/
│   └── views/
│       ├── admin/               # Admin panel views
│       ├── auth/                # Authentication views
│       ├── portfolio/           # Frontend portfolio views
│       └── layouts/             # Layout templates
├── routes/
│   └── web.php                  # Application routes
└── storage/
    ├── app/public/              # Public file storage
    └── logs/                    # Application logs
```

## 🎨 Customization

### Frontend Customization
- Edit views in `resources/views/portfolio/`
- Modify styles using Tailwind CSS classes
- Update animations in the portfolio index view

### Admin Panel Customization
- Admin views located in `resources/views/admin/`
- Premium Tailwind UI components
- Customize dashboard cards and layouts

### Theme Settings
- Access via Admin Panel → Theme Settings
- Configure primary/secondary colors
- Customize button styles
- Preview changes instantly

### Feature Toggles
- Access via Admin Panel → General Settings
- Enable/disable hero animations
- Enable/disable preloader
- Toggle section visibility

## 🔧 Configuration

### Animation Settings
Located in Settings table:
- `enable_hero_animation` - Show/hide floating particles
- `enable_preloader` - Show/hide loading animation

### Social Media Links
Configure in About section:
- Facebook
- Twitter
- LinkedIn
- GitHub
- Instagram
- YouTube

## 📝 Usage

### Adding Content

1. **Login to Admin Panel**: `/admin`
2. **Dashboard**: Overview of all content
3. **Manage Sections**: Click on sidebar menu items
4. **Add New**: Use "Create" buttons
5. **Upload Images**: Drag & drop or browse files
6. **Save**: All changes auto-save

### Managing Contact Messages

1. Navigate to Contact Messages
2. View unread count on sidebar
3. Click to read full message
4. Mark as read/unread
5. Delete spam messages

### User Management (Super Admin Only)

1. Navigate to User Management
2. Create new admin users
3. Assign roles (admin/user)
4. Edit or delete users
5. Manage permissions

## 🚀 Deployment

### Production Checklist

1. **Environment**
```bash
cp .env.example .env
# Set APP_ENV=production
# Set APP_DEBUG=false
# Generate new APP_KEY
```

2. **Optimize Application**
```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

3. **Set Permissions**
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

4. **Configure Web Server**
- Point document root to `/public`
- Enable mod_rewrite (Apache) or configure nginx
- Set up SSL certificate

5. **Database**
```bash
php artisan migrate --force
```

6. **Security**
- Change default admin credentials
- Set secure APP_KEY
- Configure CORS if needed
- Enable rate limiting

## 🛠️ Technologies Used

### Backend
- **Laravel 12.46.0** - PHP Framework
- **PHP 8.3.6** - Server-side scripting
- **MySQL 8.0** - Database
- **Laravel UI** - Authentication scaffolding

### Frontend
- **Tailwind CSS** - Utility-first CSS framework
- **Font Awesome 6.4.0** - Icons
- **AOS Library** - Scroll animations
- **Vanilla JavaScript** - Interactivity

### Tools & Libraries
- **Composer** - PHP dependency manager
- **Intervention Image** - Image processing
- **Laravel Mix/Vite** - Asset compilation

## 📊 Database Schema

### Main Tables
- `users` - User accounts with roles
- `about` - About information & social links
- `experiences` - Work experience records
- `skills` - Skills with proficiency levels
- `skill_categories` - Skill grouping
- `projects` - Portfolio projects
- `education` - Educational background
- `certifications` - Professional certifications
- `awards` - Awards & honors
- `activities` - Activities & achievements
- `resumes` - Resume content sections
- `contact_messages` - Contact form submissions
- `settings` - Application settings
- `sessions` - User sessions

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).

## 👨‍💻 Developer

**Mir Javed Jahanger**

A passionate full-stack developer specializing in modern web applications with Laravel and modern frontend technologies.

## 🐛 Bug Reports & Feature Requests

If you find a bug or have a feature request, please open an issue on GitHub with:
- Clear description
- Steps to reproduce (for bugs)
- Expected behavior
- Screenshots (if applicable)

## 📞 Support

For support, contact the developer through GitHub.

## 🙏 Acknowledgments

- Laravel Community
- Tailwind CSS Team
- Font Awesome
- AOS Animation Library
- All contributors and testers

---

**Made with ❤️ by Mir Javed Jahanger**

⭐ Star this repository if you find it helpful!
