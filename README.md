Laravel Job Board (Beginner to Pro)A robust, full-stack Job Board application built with Laravel 12. This project demonstrates the progression from a basic "Hello World" app to a complex system with Authentication, Role-Based Access Control (RBAC), and Employer Management.🚀 Features🔹 Public InterfaceJob Listings: Clean, responsive grid layout displaying available jobs.Job Details: View salary, description, and employer details.🔹 Authentication (Laravel Breeze)Secure Login & Registration: Built-in auth system.Password Reset: Standard email-based recovery.Dashboard: Protected area for logged-in users.🔹 Role-Based Access Control (RBAC)Authorization Gates: Routes protected by can:manage-jobs middleware.Admin/Employer Role:Create Jobs: Post new listings.Edit Jobs: Update salaries and titles.Delete Jobs: Remove listings.User Management: Special dashboard to view users and toggle their Admin status.Regular Users: Read-only access to job listings.⚙️ Installation Guide (How to run this project)If you are setting this up on a new machine or cloning the repository, follow these steps:Clone the repositorygit clone [https://github.com/yourusername/job-board-v2.git](https://github.com/yourusername/job-board-v2.git)
cd job-board-v2
Install PHP Dependenciescomposer install
Install Frontend Dependenciesnpm install
npm run build
Environment Setupcp .env.example .env
php artisan key:generate
Database Setup (SQLite)Windows (PowerShell):New-Item -ItemType File -Path database/database.sqlite
Mac/Linux:touch database/database.sqlite
Run Migrationsphp artisan migrate
Start the Serverphp artisan serve
🔑 Usage: Making Yourself an AdminBy default, all new registrations are Regular Users (Read-Only). To test Admin features, you must promote a user via the command line.Register a new account in the browser.Open your terminal and run Tinker:php artisan tinker
Run the following commands:// Get the first user
$user = App\Models\User::first();

// Promote to Admin
$user->is_employer = true;
$user->save();
Refresh the website. You will now see the "Create Job" and "Manage Users" buttons.🛠 Building Process (Command Log)For educational purposes, here is the chronological history of commands used to build this application from scratch.1. Project Initialization# Create project using Laravel Installer
laravel new job-board-v2
# Options selected: SQLite Database, No Starter Kit (initially)

# Start local server
php artisan serve
2. Core CRUD Logic# Generate Model & Migration
php artisan make:model Job -m

# Generate Controller
php artisan make:controller JobController

# Migrate Database
php artisan migrate
3. Adding Authentication# Install Breeze Package
composer require laravel/breeze --dev

# Run Breeze Installer (Blade Stack)
php artisan breeze:install
4. Database Schema Updates# Add Admin Flag to Users
php artisan make:migration add_is_employer_to_users_table --table=users

# Link Jobs to Users
php artisan make:migration add_user_id_to_jobs_table --table=jobs

# Apply Changes
php artisan migrate
5. Admin Features# Controller for managing users
php artisan make:controller UserController
📂 Project StructureFile PathDescriptionroutes/web.phpThe "Map". Contains all URLs, Middleware groups (auth, can:manage-jobs), and route definitions.app/Models/Job.phpThe "Blueprint". Defines $fillable fields for security and the belongsTo(User) relationship.app/Http/Controllers/JobController.phpThe "Logic". Handles listing (index), creating (store), and editing (update) jobs.app/Http/Controllers/UserController.phpThe "Admin Logic". Handles listing users and toggling their Admin status.app/Providers/AppServiceProvider.phpThe "Gatekeeper". Defines the manage-jobs gate logic.resources/views/jobs/The "Face". Contains Blade templates (index, create, edit) styled with Tailwind CSS.🐛 Troubleshooting Common Issues1. "Table 'jobs' already exists"Cause: Creating a migration for a table that is already in the database.Fix: Run php artisan migrate:fresh to wipe the database and rebuild it.2. "MassAssignmentException"Cause: Trying to save data (like Job::create) without whitelisting the columns in the Model.Fix: Add protected $fillable = ['title', 'salary']; to app/Models/Job.php.3. "MethodNotAllowedHttpException" (GET vs POST)Cause: Trying to submit a form to a route defined as GET, or vice versa.Fix: Check routes/web.php. Ensure your Form <form method="POST"> matches a Route::post(...).4. "Route [dashboard] not defined"Cause: Removing the default Breeze dashboard route without adding a replacement.Fix: Add a redirect route in web.php: Route::get('/dashboard', fn() => redirect('/jobs'))->name('dashboard');.