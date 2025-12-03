<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate; // <--- IMPORT THIS
use Illuminate\Support\ServiceProvider;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Define a Gate called "manage-jobs"
        // It returns TRUE if the user is an employer
        Gate::define('manage-jobs', function (User $user) {
            return $user->is_employer; 
        });
    }
}