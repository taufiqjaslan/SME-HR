<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\NotificationRecord;


class NotificationsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('components.navbar', function ($view) {
            $notifications = NotificationRecord::with('employee')
                ->join('users', 'notifications.user_id', '=', 'users.id')
                ->select('notifications.*', 'users.*')
                ->get();
            $view->with('notifications', $notifications);
        });
    }
}
