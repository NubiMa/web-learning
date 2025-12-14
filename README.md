# 🎓 Web Learning Platform - CodeLearn

> Platform pembelajaran web development modern berbasis Laravel 12 dengan fokus pada HTML, CSS, JavaScript, dan PHP.

[![Laravel](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.x-38B2AC.svg)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

---

## 📋 **Daftar Isi**

- [Tentang Project](#-tentang-project)
- [Fitur Utama](#-fitur-utama)
- [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
- [Requirement](#-requirement)
- [Instalasi](#-instalasi)
- [Konfigurasi](#-konfigurasi)
- [Menjalankan Aplikasi](#-menjalankan-aplikasi)
- [Seeding Data](#-seeding-data)
- [Struktur Database](#-struktur-database)
- [Struktur Folder](#-struktur-folder)
- [User Roles](#-user-roles)
- [API Endpoints](#-api-endpoints)
- [Testing](#-testing)
- [Troubleshooting](#-troubleshooting)
- [Contributing](#-contributing)
- [License](#-license)

---

## 🎯 **Tentang Project**

**CodeLearn** adalah platform pembelajaran web development yang dirancang untuk pemula hingga intermediate learners. Platform ini menyediakan:

- **4 Modul Utama**: HTML, CSS, JavaScript, PHP
- **Interactive Learning**: Code examples, live playground, quizzes
- **Progress Tracking**: Monitor perkembangan belajar secara real-time
- **Gamification**: Quiz dengan scoring system
- **Responsive Design**: Mobile-friendly interface

### **Target Audience**
- 🎓 Mahasiswa yang belajar web development
- 💼 Career switcher ke IT
- 🚀 Self-learner yang ingin belajar terstruktur
- 👨‍🏫 Instruktur yang butuh platform teaching

---

## ✨ **Fitur Utama**

### **Untuk User (Learner)**
- ✅ **Multi-Module Learning**: HTML, CSS, JavaScript, PHP
- ✅ **Chapter-based Content**: Materi dibagi per chapter yang mudah dicerna
- ✅ **Code Examples**: Setiap chapter dilengkapi contoh kode
- ✅ **Interactive Quizzes**: Test pemahaman dengan multiple choice
- ✅ **Progress Tracking**: 
  - Per-chapter completion
  - Module progress percentage
  - Overall statistics
- ✅ **Quiz System**:
  - Multiple attempts
  - Score tracking
  - Best score recording
  - Detailed answer review
- ✅ **User Dashboard**: Overview learning progress
- ✅ **Profile Management**: Edit profile, change password

### **Untuk Admin**
- ✅ **Content Management**:
  - CRUD Modules
  - CRUD Chapters (with code examples)
  - CRUD Quizzes & Questions
- ✅ **User Management**:
  - View all users
  - Edit user roles
  - Monitor user progress
- ✅ **Analytics Dashboard**:
  - Total users, modules, chapters
  - Recent user activities
  - Quiz attempt statistics

### **Fitur Teknis**
- ✅ **Authentication**: Laravel Breeze
- ✅ **Authorization**: Role-based (Admin/User)
- ✅ **Database**: SQLite (easy setup)
- ✅ **Seeder**: Pre-populated content
- ✅ **Responsive**: Mobile, tablet, desktop
- ✅ **Modern UI**: Tailwind CSS utility-first

---

## 🛠️ **Teknologi yang Digunakan**

### **Backend**
| Teknologi | Versi | Fungsi |
|-----------|-------|--------|
| **PHP** | 8.2+ | Server-side scripting |
| **Laravel** | 12.x | PHP Framework |
| **SQLite** | Latest | Database (file-based) |
| **Laravel Breeze** | 2.3 | Authentication scaffolding |

### **Frontend**
| Teknologi | Versi | Fungsi |
|-----------|-------|--------|
| **Tailwind CSS** | 3.x | Utility-first CSS framework |
| **Alpine.js** | 3.x | Lightweight JavaScript framework |
| **Vite** | 7.x | Frontend build tool |
| **Blade** | - | Laravel templating engine |

### **Development Tools**
- **Composer** - PHP dependency manager
- **NPM** - JavaScript package manager
- **Laravel Pint** - Code styling
- **Laravel IDE Helper** - Better IDE autocomplete

---

## 📦 **Requirement**

### **Minimum Requirements**
```bash
PHP >= 8.2
Composer >= 2.0
Node.js >= 18.x
NPM >= 9.x
SQLite Extension (biasanya sudah include di PHP)
```

### **Recommended**
```bash
PHP 8.3
Composer 2.7+
Node.js 20.x (LTS)
NPM 10.x
16GB RAM (untuk development)
SSD Storage
```

### **Cek PHP Extensions**
```bash
php -m | grep -E "sqlite3|pdo_sqlite|openssl|mbstring|tokenizer|xml|ctype|json|bcmath"
```

Jika ada yang missing, install:
```bash
# Ubuntu/Debian
sudo apt install php8.2-sqlite3 php8.2-mbstring php8.2-xml

# macOS (Homebrew)
brew install php@8.2

# Windows (XAMPP/Laragon sudah include)
```

---

## 🚀 **Instalasi**

### **1. Clone Repository**
```bash
git clone https://github.com/yourusername/web-learning-platform.git
cd web-learning-platform
```

### **2. Install PHP Dependencies**
```bash
composer install
```

**Troubleshooting:**
```bash
# Jika ada error memory limit
php -d memory_limit=512M /usr/local/bin/composer install

# Jika ada error extensions
composer install --ignore-platform-reqs  # NOT RECOMMENDED for production
```

### **3. Install JavaScript Dependencies**
```bash
npm install
```

### **4. Setup Environment**
```bash
# Copy file .env
cp .env.example .env

# Generate application key
php artisan key:generate
```

### **5. Setup Database**
```bash
# Create SQLite database file
touch database/database.sqlite

# Run migrations
php artisan migrate

# Seed dengan data dummy
php artisan db:seed
```

### **6. Build Frontend Assets**
```bash
# Development mode (dengan hot reload)
npm run dev

# Production build
npm run build
```

---

## ⚙️ **Konfigurasi**

### **File `.env`**

```env
# Application
APP_NAME="CodeLearn"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database (SQLite)
DB_CONNECTION=sqlite
# DB_DATABASE akan otomatis ke database/database.sqlite

# Session
SESSION_DRIVER=database
SESSION_LIFETIME=120

# Cache
CACHE_STORE=database

# Queue
QUEUE_CONNECTION=database

# Mail (optional, untuk password reset)
MAIL_MAILER=log
MAIL_FROM_ADDRESS="hello@codelearn.id"
MAIL_FROM_NAME="${APP_NAME}"
```

### **Konfigurasi Timezone (Optional)**
Edit `config/app.php`:
```php
'timezone' => 'Asia/Jakarta',  // Sesuaikan dengan zona waktu Anda
'locale' => 'id',               // Bahasa Indonesia
```

---

## 🏃 **Menjalankan Aplikasi**

### **Development Mode**

**Terminal 1: Laravel Server**
```bash
php artisan serve
# Akses: http://localhost:8000
```

**Terminal 2: Vite Dev Server (Hot Reload)**
```bash
npm run dev
```

### **Production Mode**

```bash
# Build assets
npm run build

# Jalankan dengan production config
php artisan serve --env=production
```

### **Menggunakan Laravel Sail (Docker)**
```bash
# Install Sail
composer require laravel/sail --dev

# Publish Sail
php artisan sail:install

# Start containers
./vendor/bin/sail up -d

# Akses
http://localhost
```

---

## 🌱 **Seeding Data**

### **Full Seeding**
```bash
php artisan db:seed
```

Ini akan create:
- ✅ 1 Admin user
- ✅ 3 Regular users
- ✅ 10 Dummy users
- ✅ 4 Modules (HTML, CSS, JS, PHP)
- ✅ ~15 Chapters dengan content
- ✅ 4 Quizzes dengan questions

### **Seeding Individual**
```bash
# Only users
php artisan db:seed --class=UserSeeder

# Only modules
php artisan db:seed --class=ModuleSeeder

# Only chapters
php artisan db:seed --class=ChapterSeeder

# Only quizzes
php artisan db:seed --class=QuizSeeder
```

### **Fresh Migration + Seed**
```bash
php artisan migrate:fresh --seed
```
⚠️ **WARNING**: Ini akan hapus semua data existing!

---

## 🗄️ **Struktur Database**

### **ERD Overview**

```
users (1) ──────── (*) user_progress (*) ──────── (1) chapters
   │                                                    │
   │                                                    │
   │                                              (1) modules (*)
   │                                                    │
   └──────── (*) quiz_attempts (*) ──────── (1) quizzes
                                                        │
                                                        │
                                              (*) quiz_questions
```

### **Tables**

#### **users**
```sql
- id (primary key)
- name (string)
- email (string, unique)
- password (hashed)
- role (enum: 'admin', 'user')
- timestamps
```

#### **modules**
```sql
- id (primary key)
- title (string)
- slug (string, unique)
- description (text)
- icon (emoji string)
- color (string)
- order (integer)
- is_active (boolean)
- timestamps
```

#### **chapters**
```sql
- id (primary key)
- module_id (foreign key → modules)
- title (string)
- slug (string)
- content (long text)
- code_example (long text, nullable)
- explanation (text, nullable)
- order (integer)
- is_active (boolean)
- timestamps
```

#### **user_progress**
```sql
- id (primary key)
- user_id (foreign key → users)
- chapter_id (foreign key → chapters)
- completed (boolean)
- completed_at (timestamp, nullable)
- timestamps
- UNIQUE(user_id, chapter_id)
```

#### **quizzes**
```sql
- id (primary key)
- module_id (foreign key → modules)
- title (string)
- description (text, nullable)
- passing_score (integer, default 70)
- time_limit (integer, nullable, in minutes)
- is_active (boolean)
- timestamps
```

#### **quiz_questions**
```sql
- id (primary key)
- quiz_id (foreign key → quizzes)
- question (text)
- options (json array)
- correct_answer (integer, 0-3)
- explanation (text, nullable)
- order (integer)
- timestamps
```

#### **quiz_attempts**
```sql
- id (primary key)
- user_id (foreign key → users)
- quiz_id (foreign key → quizzes)
- score (integer, percentage)
- correct_answers (integer)
- total_questions (integer)
- answers (json)
- passed (boolean)
- timestamps
```

---

## 📁 **Struktur Folder**

```
web-learning-platform/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/           # Admin controllers
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── ModuleController.php
│   │   │   │   ├── ChapterController.php
│   │   │   │   ├── QuizController.php
│   │   │   │   ├── QuestionController.php
│   │   │   │   └── UserController.php
│   │   │   ├── User/            # User controllers
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── ModuleController.php
│   │   │   │   ├── ChapterController.php
│   │   │   │   └── QuizController.php
│   │   │   ├── Auth/            # Authentication
│   │   │   ├── Controller.php
│   │   │   ├── HomeController.php
│   │   │   └── ProfileController.php
│   │   │
│   │   ├── Middleware/
│   │   │   └── IsAdmin.php      # Check admin role
│   │   │
│   │   └── Requests/
│   │       └── Auth/
│   │
│   ├── Models/
│   │   ├── User.php
│   │   ├── Module.php
│   │   ├── Chapter.php
│   │   ├── UserProgress.php
│   │   ├── Quiz.php
│   │   ├── QuizQuestion.php
│   │   └── QuizAttempt.php
│   │
│   └── View/
│       └── Components/
│
├── database/
│   ├── migrations/              # Database schema
│   ├── seeders/                 # Sample data
│   │   ├── UserSeeder.php
│   │   ├── ModuleSeeder.php
│   │   ├── ChapterSeeder.php
│   │   └── QuizSeeder.php
│   └── database.sqlite          # SQLite database file
│
├── resources/
│   ├── css/
│   │   └── app.css              # Tailwind imports
│   ├── js/
│   │   ├── app.js
│   │   └── bootstrap.js
│   └── views/
│       ├── layouts/
│       │   ├── admin.blade.php  # Admin layout
│       │   ├── user.blade.php   # User layout
│       │   └── guest.blade.php
│       ├── admin/               # Admin views
│       │   ├── dashboard.blade.php
│       │   ├── modules/
│       │   ├── chapters/
│       │   ├── quizzes/
│       │   ├── questions/
│       │   └── users/
│       ├── user/                # User views
│       │   ├── dashboard.blade.php
│       │   ├── modules/
│       │   ├── chapters/
│       │   ├── quizzes/
│       │   └── profile/
│       ├── auth/                # Auth views
│       └── welcome.blade.php    # Landing page
│
├── routes/
│   ├── web.php                  # Main routes
│   └── auth.php                 # Auth routes (Breeze)
│
├── public/
│   ├── index.php
│   └── build/                   # Compiled assets
│
├── tests/
│   ├── Feature/
│   └── Unit/
│
├── .env                         # Environment config
├── .env.example
├── composer.json
├── package.json
├── vite.config.js
├── tailwind.config.js
└── README.md
```

---

## 👥 **User Roles**

### **Default Credentials (After Seeding)**

#### **Admin**
```
Email: admin@example.com
Password: password
```

**Permissions:**
- ✅ Full CRUD modules, chapters, quizzes, questions
- ✅ User management
- ✅ View all user progress
- ✅ Access admin dashboard
- ❌ Cannot take quizzes (admin only manages)

#### **Regular User**
```
Email: john@example.com
Password: password
```

**Permissions:**
- ✅ Access learning modules
- ✅ Complete chapters
- ✅ Take quizzes
- ✅ View own progress
- ✅ Edit own profile
- ❌ No access to admin panel

#### **Additional Test Users**
```
user1@example.com ... user10@example.com
Password: password
```

---

## 🔌 **API Endpoints**

### **Public Routes**
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/` | Landing page |
| GET | `/login` | Login page |
| POST | `/login` | Login action |
| GET | `/register` | Register page |
| POST | `/register` | Register action |

### **User Routes** (Auth Required)
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/user/dashboard` | User dashboard |
| GET | `/user/modules` | List all modules |
| GET | `/user/modules/{slug}` | Module detail |
| GET | `/user/chapters/{id}` | Chapter content |
| POST | `/user/chapters/{id}/complete` | Mark chapter complete |
| GET | `/user/quizzes/{id}` | Quiz page |
| POST | `/user/quizzes/{id}/submit` | Submit quiz |
| GET | `/user/quizzes/{quiz}/results/{attempt}` | Quiz results |
| GET | `/user/settings` | Profile settings |
| PATCH | `/user/settings` | Update profile |

### **Admin Routes** (Admin Role Required)
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/admin/dashboard` | Admin dashboard |
| Resource | `/admin/modules` | CRUD modules |
| POST | `/admin/modules/{id}/toggle` | Toggle active status |
| Resource | `/admin/chapters` | CRUD chapters |
| POST | `/admin/chapters/{id}/toggle` | Toggle active status |
| Resource | `/admin/quizzes` | CRUD quizzes |
| POST | `/admin/quizzes/{id}/toggle` | Toggle active status |
| GET | `/admin/quizzes/{id}/questions/create` | Add question |
| POST | `/admin/quizzes/{id}/questions` | Store question |
| PUT | `/admin/questions/{id}` | Update question |
| DELETE | `/admin/questions/{id}` | Delete question |
| Resource | `/admin/users` | User management |

---

## 🧪 **Testing**

### **Setup Testing Environment**
```bash
# Copy .env for testing
cp .env .env.testing

# Edit .env.testing
DB_CONNECTION=sqlite
DB_DATABASE=:memory:
```

### **Run Tests**
```bash
# All tests
php artisan test

# Specific test file
php artisan test tests/Feature/Auth/LoginTest.php

# With coverage
php artisan test --coverage
```

### **Feature Tests Available**
- ✅ Authentication tests
- ✅ Registration tests
- ✅ Password reset tests
- ✅ Email verification tests
- ✅ Profile update tests

### **Create New Test**
```bash
# Feature test
php artisan make:test QuizTest

# Unit test
php artisan make:test QuizTest --unit
```

---

## 🐛 **Troubleshooting**

### **Problem: Database tidak terdeteksi**
```bash
# Solution 1: Pastikan file exists
ls -la database/database.sqlite

# Solution 2: Create manual
touch database/database.sqlite
php artisan migrate:fresh --seed

# Solution 3: Permission issue (Linux/Mac)
chmod 664 database/database.sqlite
```

### **Problem: Vite error "ERR_CONNECTION_REFUSED"**
```bash
# Solution: Pastikan npm run dev berjalan
npm run dev

# Atau build untuk production
npm run build
```

### **Problem: Class not found after composer install**
```bash
# Clear cache
php artisan clear-compiled
php artisan config:clear
php artisan cache:clear

# Regenerate autoload
composer dump-autoload

# Rebuild IDE helper
php artisan ide-helper:generate
```

### **Problem: 419 Page Expired (CSRF)**
```bash
# Clear session & cache
php artisan session:clear
php artisan cache:clear

# Regenerate key
php artisan key:generate
```

### **Problem: Storage link broken**
```bash
# Create storage link
php artisan storage:link

# Jika masih error, manual symlink
ln -s ../storage/app/public public/storage
```

### **Problem: Permission denied (Linux/Mac)**
```bash
# Give proper permissions
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R $USER:www-data storage bootstrap/cache
```

### **Problem: Blank page / 500 error**
```bash
# Check logs
tail -f storage/logs/laravel.log

# Enable debug mode
# Di .env
APP_DEBUG=true
```

---

## 🎨 **Customization**

### **Mengubah Logo/Brand**
```php
// resources/views/layouts/user.blade.php
<span class="ml-3 text-xl font-bold text-gray-900">YourBrand</span>
```

### **Menambah Module Baru**
```bash
# 1. Create via seeder
# Edit database/seeders/ModuleSeeder.php

# 2. Create via admin panel
# Login as admin → Modules → Create Module
```

### **Customize Colors**
```js
// tailwind.config.js
export default {
    theme: {
        extend: {
            colors: {
                primary: '#your-color',
            }
        }
    }
}
```

---

## 📚 **Resources**

### **Official Documentation**
- [Laravel 12 Docs](https://laravel.com/docs/12.x)
- [Tailwind CSS Docs](https://tailwindcss.com/docs)
- [Alpine.js Docs](https://alpinejs.dev)

### **Learning Path**
1. Pelajari Laravel basics
2. Understand Blade templating
3. Master Tailwind utility classes
4. Learn Alpine.js for interactivity

### **Useful Commands**
```bash
# List all routes
php artisan route:list

# Check environment
php artisan about

# Optimize for production
php artisan optimize

# Clear all cache
php artisan optimize:clear
```

---

## 🤝 **Contributing**

Contributions are welcome! Please follow these steps:

1. **Fork the repository**
2. **Create feature branch**
   ```bash
   git checkout -b feature/AmazingFeature
   ```
3. **Commit changes**
   ```bash
   git commit -m 'Add some AmazingFeature'
   ```
4. **Push to branch**
   ```bash
   git push origin feature/AmazingFeature
   ```
5. **Open Pull Request**

### **Coding Standards**
- Follow PSR-12 for PHP
- Use Laravel Pint for code styling
- Write meaningful commit messages
- Add tests for new features

---

## 📝 **License**

This project is licensed under the **MIT License**.

```
MIT License

Copyright (c) 2025 CodeLearn

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction...
```

---

## 📧 **Contact**

**Project Maintainer:** NubiMa

- 📧 Email: muhfadhilmaulana28@gmail.com
- 📷 Instagram : @_fadhil.maulana
<!-- - 💼 LinkedIn: [CodeLearn](https://linkedin.com/company/codelearn)
- 🌐 Website: https://codelearn.id -->

---

## 🙏 **Acknowledgments**

- Laravel Team for amazing framework
- Tailwind Labs for utility-first CSS
- Alpine.js for reactive components
- Community contributors

---

## 📈 **Roadmap**

### **Version 1.0** (Current)
- ✅ Basic CRUD functionality
- ✅ User authentication
- ✅ Progress tracking
- ✅ Quiz system

### **Version 1.1** (Planned)
- [ ] Certificate generation (PDF)
- [ ] Email notifications
- [ ] Social login (Google, GitHub)
- [ ] Advanced analytics

### **Version 2.0** (Future)
- [ ] API for mobile app
- [ ] Real-time chat/discussion
- [ ] Leaderboard & badges
- [ ] Code playground enhancement
- [ ] Video lessons integration

---

**⭐ If you find this project helpful, please give it a star on GitHub!**

**🐛 Found a bug? [Open an issue](https://github.com/NubiMa/web-learning-platform/issues)**

---

*Last updated: December 2025*