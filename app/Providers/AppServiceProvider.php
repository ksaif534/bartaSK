<?php

namespace App\Providers;

use App\Events\SomeoneCommentsOnPost;
use App\Events\UserLikesPost;
use App\Listeners\SendInAppCommentNotification;
use App\Listeners\SendInAppLikeNotification;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

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
        Event::listen(
            UserLikesPost::class,
            SendInAppLikeNotification::class
        );
        Event::listen(
            SomeoneCommentsOnPost::class,
            SendInAppCommentNotification::class
        );
    }
}
