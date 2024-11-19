<?php

namespace App\Listeners;

use App\Events\UserLikesPost;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendInAppLikeNotification
{
    public $tries = 1; // Ensure no automatic retries are attempted

    /**
     * Create the event listener.
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(UserLikesPost $event): void
    {
        //
    }
}
