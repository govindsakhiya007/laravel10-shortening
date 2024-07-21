<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Ticket;
use App\Models\Event;

class AttendeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $eventIds = Event::where('organizer_id', \Auth::id())->pluck('id');

            // Get tickets for these events
            $tickets = Ticket::whereIn('event_id', $eventIds)
                ->with(['ticketType', 'event', 'user'])
                ->get();

            return DataTables::of($tickets)
                ->addIndexColumn()
                ->addColumn('name', function ($ticket) {
                    return $ticket->user ? $ticket->user->name : 'N/A';
                })
               ->addColumn('email', function ($ticket) {
                    return $ticket->user ? $ticket->user->email : 'N/A';
                })
                ->addColumn('ticket_type', function ($ticket) {
                    return $ticket->ticketType ? $ticket->ticketType->name : 'N/A';
                })
                ->addColumn('event_title', function ($ticket) {
                    return $ticket->event ? $ticket->event->title : 'N/A';
                })
                ->addColumn('price', function ($ticket) {
                    return $ticket->ticketType ? $ticket->ticketType->price : 'N/A';
                })
                ->addColumn('payment', function ($ticket) {
                    return $ticket->is_sold ? 'Completed': 'Pending';
                })
                ->rawColumns(['name', 'email', 'ticket_type', 'event_title', 'price'])
                ->make(true);
        }

        return view('attendees.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Organizer dashboard.
     */
    public function dashboard(Request $request)
    {   
        if ($request->ajax()) {
            $tickets = Ticket::select(
                    'user_id',
                    'ticket_type_id',
                    'event_id',
                    \DB::raw('COUNT(*) as total_quantity'), // Count total tickets
                    \DB::raw('SUM(ticket_types.price) as total_price') // Calculate total price
                )
                ->join('ticket_types', 'tickets.ticket_type_id', '=', 'ticket_types.id')
                ->groupBy('user_id', 'ticket_type_id', 'event_id')
                ->with(['ticketType', 'user', 'event'])
                ->get();

            return DataTables::of($tickets)
                ->addIndexColumn()
                ->addColumn('name', function ($ticket) {
                    return $ticket->user ? $ticket->user->name : 'N/A';
                })
                ->addColumn('email', function ($ticket) {
                    return $ticket->user ? $ticket->user->email : 'N/A';
                })
                ->addColumn('event_title', function ($ticket) {
                    return $ticket->event ? $ticket->event->title : 'N/A';
                })
                ->addColumn('ticket_type', function ($ticket) {
                    return $ticket->ticketType ? $ticket->ticketType->name : 'N/A';
                })
                ->addColumn('price', function ($ticket) {
                    return $ticket->ticketType ? $ticket->ticketType->price : 0;
                })
                ->addColumn('total_quantity', function ($data) {
                    return $data->total_quantity;
                })
                ->addColumn('total_price', function ($data) {
                    return number_format($data->total_price, 2);
                })
                ->toJson();
        }

        return view('events.dashboard');
    }
}
