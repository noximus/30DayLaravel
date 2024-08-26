<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Job;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     * do stuff in here that you want to happen every time the app starts
     */
    public function boot(): void
    {
        Model::preventLazyLoading();

        // config paginator to bootstrap
        // Paginator::useBootstrapFive();

        Gate::define('edit-job', function (User $user, Job $job) {
            return $job->employer->user->is($user);
        });
        // Gate::define('update-job', function (User $user, Job $job) {
        //     return $job->employer->user->is($user);
        // });
        // Gate::define('destroy-job', function (User $user, Job $job) {
        //     return $job->employer->user->is($user);
        // });
    }
}
