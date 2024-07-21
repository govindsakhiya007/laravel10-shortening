<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

/**
 * Class HomeController
 * 
 * This controller handles the logic for displaying the homepage.
 */
class HomeController extends Controller
{
    /**
     * Display the homepage with upcoming events.
     * 
     * This method retrieves upcoming events for the authenticated user. 
     * If the user is an attendee (role = 2), it fetches the events the user has tickets for.
     * If the user is an organizer, it fetches the events organized by the user.
     *
     * @return \Illuminate\View\View The view displaying the upcoming events.
     */
    public function homepage() {
        $user = \Auth::user();

        // Check if the user is an attendee
        if ($user->role == 2) {
            // Retrieve events the user has tickets for
            $upcomingEvents = Event::whereHas('tickets', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->where('date', '>', now())
            ->orderBy('date')
            ->get();
        } else {
            // Retrieve events organized by the user
            $upcomingEvents = Event::where('organizer_id', $user->id)
                ->where('date', '>', now())
                ->orderBy('date')
                ->get();
        }

        // Return the view with the upcoming events
        return view('welcome', compact('upcomingEvents'));
    }
}