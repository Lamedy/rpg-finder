<?php

namespace App\Providers;

use App\Models\NoticeList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $count = NoticeList::where('for_user', Auth::id())
                    ->where('read_status', false)
                    ->count();

                $view->with('unreadNoticesCount', $count);
            }
        });
    }
}
