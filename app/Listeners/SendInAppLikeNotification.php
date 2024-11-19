<?php

namespace App\Listeners;

use App\Events\UserLikesPost;

class SendInAppLikeNotification
{
    public $tries = 1; // Ensure no automatic retries are attempted

    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(UserLikesPost $event): void
    {
        //
    }
}
