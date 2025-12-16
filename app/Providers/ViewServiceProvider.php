<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ContactAdvice;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer([
            'admin.dashboard.*',
            'admin.dashboard.component.*',
            'admin.layouts.*',
        ], function ($view) {

            $contactUnreadCount = ContactAdvice::where('status', 0)->count();

            $latestContactAdvices = ContactAdvice::latest()->limit(5)->get();

            $view->with(compact(
                'contactUnreadCount',
                'latestContactAdvices'
            ));
        });
    }
}
