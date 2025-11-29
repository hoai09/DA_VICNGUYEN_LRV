<?php

namespace App\Providers;

use App\Models\Project;
use App\Models\CompanyInfo;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        View::composer('*', function ($view) {
            $view->with('allProjects', Project::select('title', 'slug')->get());

            $social = CompanyInfo::firstOrCreate(['type' => 'social']);
            $view->with('social', $social);
        });
    }
}
