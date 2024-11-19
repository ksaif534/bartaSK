# barta-social-media-app

General guidelines to use this application:

1. First go to the `barta`(or the project root) directory and run `php artisan serve` to start the application.

2. Before starting the application, make sure to change the database configurations in the environment(`.env` file)

# livewire update

1. Added `Show more` button which loads 10 more results on click.

2. Added each post `details navigation`, `edit/update` & `delete` functionality with livewire. 

# In-App & Realtime Notification for Like and Comment

1. Click on the `like` and `comment` icons in the app (for each post) for Liking and Commenting on a post.

2. Don't forget to run `php artisan reverb:start` before testing out realtime notification sending. Also check the 
   browser console to ensure realtime notification is actually being sent. 
