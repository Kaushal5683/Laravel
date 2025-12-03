# Laravel Job Board (Beginner to Pro)

A robust, full-stack Job Board application built with **Laravel 12**. This project demonstrates the progression from a basic "Hello World" app to a complex system with Authentication, Role-Based Access Control (RBAC), and Employer Management.

## 🚀 Features

### 🔹 Public Interface
* **Job Listings:** Clean, responsive grid layout displaying available jobs.
* **CRUD Operations:** Full **C**reate, **R**ead, **U**pdate, and **D**elete functionality for Job entities.

### 🔹 Authentication & Authorization
* **Secure Login & Registration:** Implemented using **Laravel Breeze**.
* **Role Management:** Access controlled by an `is_employer` flag.
    * **Admins (Employers):** Can manage users and all job listings.
    * **Regular Users:** Read-only access to job listings.

### 🔹 Core Architecture
* **MVC:** Uses the Model-View-Controller design pattern for separation of concerns.
* **Eloquent ORM:** Database interactions are managed through Eloquent Models.

---

## ⚙️ Installation Guide (How to run this project)

Follow these steps to set up the project locally. It is designed to run perfectly on **Laravel Herd** or any standard PHP environment.

### 1. Clone the repository
```bash
git clone [https://github.com/yourusername/job-board-v2.git](https://github.com/yourusername/job-board-v2.git)
cd job-board-v2

# Job Board V2 - Laravel Application

A full-featured Job Board application built with Laravel, featuring
authentication, job posting CRUD operations, and admin management.

------------------------------------------------------------------------

## ✅ System Requirements

-   PHP 8.1+
-   Composer
-   Node.js & NPM
-   SQLite (or any other supported DB)
-   Laravel CLI

------------------------------------------------------------------------

## 📦 Installation Steps

### 1️⃣ Install PHP Dependencies

``` bash
composer install
```

------------------------------------------------------------------------

### 2️⃣ Install Frontend Dependencies

``` bash
npm install
npm run build
```

------------------------------------------------------------------------

### 3️⃣ Environment Setup

``` bash
cp .env.example .env
php artisan key:generate
```

------------------------------------------------------------------------

### 4️⃣ Database Setup (SQLite)

Ensure the database file exists:

``` bash
touch database/database.sqlite
```

Update `.env` file:

``` env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database/database.sqlite
```

------------------------------------------------------------------------

### 5️⃣ Run Migrations

This builds the necessary tables such as users and jobs.

``` bash
php artisan migrate
```

------------------------------------------------------------------------

### 6️⃣ Start the Server

``` bash
php artisan serve
```

------------------------------------------------------------------------

## 🔑 Making Yourself an Admin (Employer Access)

After registration, all users are **standard users by default**.\
To access **Admin features**, follow these steps:

1.  **Register a new account** in the browser.
2.  Open your terminal and run:

``` bash
php artisan tinker
```

3.  Run the following PHP commands:

``` php
// Get the first user (the one you just registered)
$user = App\Models\User::first();

// Set the Admin flag to TRUE
$user->is_employer = true;
$user->save();
```

4.  **Refresh the website**.

You will now see: - ✅ Create Job button\
- ✅ Manage Users option

------------------------------------------------------------------------

## 🛠 Building Process (Command Log)

This section shows every essential command used to build the
application's core architecture.

------------------------------------------------------------------------

### 1️⃣ Project Initialization & Authentication Setup

``` bash
# Create project and enter directory
laravel new job-board-v2 && cd job-board-v2

# Install Authentication (Blade Stack)
composer require laravel/breeze --dev
php artisan breeze:install

npm install && npm run build
```

------------------------------------------------------------------------

### 2️⃣ Job Module (Core CRUD)

``` bash
# Model & Migration (for the 'jobs' table)
php artisan make:model Job -m

# Controller (for CRUD logic)
php artisan make:controller JobController

# Migrate Database
php artisan migrate
```

------------------------------------------------------------------------

### 3️⃣ Database Updates & Relationships

``` bash
# Add is_employer column to users
php artisan make:migration add_is_employer_to_users_table --table=users

# Add user_id column to jobs (for the relationship)
php artisan make:migration add_user_id_to_jobs_table --table=jobs

# Reset and rebuild database (safe during development)
php artisan migrate:fresh
```

------------------------------------------------------------------------

### 4️⃣ Admin Management Controller

``` bash
# Controller for managing User roles
php artisan make:controller UserController
```

------------------------------------------------------------------------

## 📂 Project Architecture Reference

  ------------------------------------------------------------------------------
  File Path                                  Purpose
  ------------------------------------------ -----------------------------------
  `routes/web.php`                           Routing: Defines URLs. Middleware:
                                             Applies security (`auth`) and
                                             authorization (`can:manage-jobs`).

  `app/Models/Job.php`                       Model: Defines `belongsTo(User)`
                                             relationship. Security: Uses
                                             `$fillable` whitelist.

  `app/Http/Controllers/JobController.php`   Controller: Implements CRUD logic
                                             (`index`, `store`, `update`,
                                             `destroy`). Uses Route Model
                                             Binding (`Job $job`).

  `app/Providers/AppServiceProvider.php`     Authorization: Defines the custom
                                             Gate rule
                                             (`Gate::define('manage-jobs')`).

  `database/migrations/*`                    Migrations: Controls schema changes
                                             (`is_employer`, `user_id`).

  `resources/views/jobs/index.blade.php`     Blade View: Uses `@foreach`, `@can`
                                             to render data and conditionally
                                             show Admin buttons.
  ------------------------------------------------------------------------------

------------------------------------------------------------------------

## ✅ Features Implemented

-   User Authentication
-   Job Posting CRUD
-   Employer/Admin Role Management
-   Secure Authorization using Gates
-   SQLite Database Support
-   Clean MVC Structure

------------------------------------------------------------------------

## 🚀 You're Good to Go!

If you follow all the steps above correctly, your Job Board application
will be fully functional with admin access enabled.
