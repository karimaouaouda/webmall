import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssHost: import.meta.env.VITE_REVERB_HOST,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: true,
    enabledTransports: ['wss', 'ws'],
    
});




console.log(import.meta.env.VITE_REVERB_SCHEME === "https")

Pusher.logToConsole = true

let f = window.Echo.channel('test').listen('Test', function(data){
    console.log(data);
})