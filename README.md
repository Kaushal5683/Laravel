Laravel Job Board (Beginner to Pro)

A robust, full-stack Job Board application built with Laravel 12. This project demonstrates the progression from a basic "Hello World" app to a complex system with Authentication, Role-Based Access Control (RBAC), and Employer Management.

🚀 Features

🔹 Public Interface

Job Listings: Clean, responsive grid layout displaying available jobs.

CRUD Operations: Full Create, Read, Update, and Delete functionality for Job entities.

🔹 Authentication & Authorization

Secure Login & Registration: Implemented using Laravel Breeze.

Role Management: Access controlled by an is_employer flag.

Admins (Employers): Can manage users and all job listings.

Regular Users: Read-only access to job listings.

🔹 Core Architecture

MVC: Uses the Model-View-Controller design pattern for separation of concerns.

Eloquent ORM: Database interactions are managed through Eloquent Models.

⚙️ Installation Guide (How to run this project)

Follow these steps to set up the project locally. It is designed to run perfectly on Laravel Herd or any standard PHP environment.

Clone the repository (if starting from a Git repository)

git clone [https://github.com/yourusername/job-board-v2.git](https://github.com/yourusername/job-board-v2.git)
cd job-board-v2


Install PHP Dependencies

composer install


Install Frontend Dependencies

npm install
npm run build


Environment Setup

cp .env.example .env
php artisan key:generate


Database Setup (SQLite)
Ensure the database/database.sqlite file exists:

touch database/database.sqlite


Run Migrations
This builds the necessary tables (users, jobs, etc.).

php artisan migrate


Start the Server

php artisan serve


🔑 Usage: Making Yourself an Admin

After registration, all users are standard by default. You must use the command line to grant the is_employer status.

Register a new account in the browser.

Open your terminal and run Tinker:

php artisan tinker


Run the following commands:

// Get the first user (the one you just registered)
$user = App\Models\User::first();

// Set the Admin flag to TRUE
$user->is_employer = true;
$user->save();


Refresh the website. You will now see the "Create Job" and "Manage Users" buttons.

🛠 Building Process (Command Log)

This log shows every essential command used to build the application's core architecture.

1. Project Initialization & Setup

# Create project and enter directory
laravel new job-board-v2 && cd job-board-v2

# Install Authentication (Blade Stack)
composer require laravel/breeze --dev
php artisan breeze:install
npm install && npm run build


2. Job Module (The Core CRUD)

# Model & Migration (for the 'jobs' table)
php artisan make:model Job -m

# Controller (for CRUD logic)
php artisan make:controller JobController

# Migrate Database
php artisan migrate


3. Database Updates & Relationships

# Add is_employer column to users
php artisan make:migration add_is_employer_to_users_table --table=users

# Add user_id column to jobs (for the relationship)
php artisan make:migration add_user_id_to_jobs_table --table=jobs

# Reset and rebuild database (safe during development)
php artisan migrate:fresh 


4. Admin Management

# Controller for managing User roles
php artisan make:controller UserController


📂 Project Architecture Reference

File Path

Function & Concepts Learned

routes/web.php

Routing: Defines URLs. Middleware: Applies security (auth) and authorization (can:manage-jobs).

app/Models/Job.php

Model: Defines the belongsTo(User) relationship. Security: Contains the $fillable mass assignment whitelist.

app/Http/Controllers/JobController.php

Controller: Implements CRUD logic (index, store, update, destroy). Uses Route Model Binding (Job $job).

app/Providers/AppServiceProvider.php

Authorization: Defines the custom rule (Gate::define('manage-jobs')).

database/migrations/...

Migrations: Version control for the database schema (used to add is_employer and user_id).

resources/views/jobs/index.blade.php

View: Uses Blade syntax (@foreach, @can) for rendering data and conditionally showing Admin buttons.