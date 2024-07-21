import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

// --
// Listening to a channel and event
window.Echo.channel('tickets')
    .listen('.ticket.purchased', (e) => {
        console.log('Ticket purchased:', e.ticket);
        $('#ticket-sales-table').DataTable().ajax.reload();
    });
