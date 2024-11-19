import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.VITE_PUSHER_APP_CLUSTER,
//     forceTLS: true
//     wsHost: import.meta.env.VITE_REVERB_HOST,
//     wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
//     wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT,
    wssPort: import.meta.env.VITE_REVERB_PORT,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

function changeSvg(notificationCount){

    console.log('Notification Count:' + notificationCount);

    const newSvgBtn = `
        <button
        @click="open = !open"
        type="button"
        class="rounded-full bg-white p-2 text-gray-800 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
        id="notification-menu-button"
        aria-expanded="false"
        aria-haspopup="true"
        >
            <span class="sr-only">View notifications</span>
            <!-- Heroicon name: outline/bell -->
            <svg
                class="h-6 w-6"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                aria-hidden="true">
                <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>
            <div class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-gray-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900">${notificationCount++}</div>
        </button>
    `;
    document.getElementById('svg-container').innerHTML = newSvgBtn;
}

window.Echo.private(`liked-user`)
    .listen('UserLikesPost', (e) => {
        changeSvg(notificationCount);
        console.log('Congratulations, event broadcasted on the client side. Someone Liked your Post');
    })

window.Echo.private(`commentedUser`)
    .listen('SomeoneCommentsOnPost', (e) => {
        changeSvg(notificationCount);
        console.log('Congrats, Someone Commented on your post');
    })

// window.Echo.channel(`test-user`)
//     .listen('UserLikesPost', (e) => {
//         console.log('user liked your post');
//         alert(e.message);
//     })