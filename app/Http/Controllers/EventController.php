<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Cache;

use App\Http\Requests\StoreEventRequest;

use App\Models\Event;
use App\Models\TicketType;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check.event.role:1')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $cacheKey = 'events_list';
            $user = Auth::user();

            return Cache::remember($cacheKey, 60, function () use ($user) {
                $events = Event::select(['id', 'title', 'description', 'date', 'location', 'ticket_availability', 'created_at']);
                if($user->role == 1) {
                    $events->where('organizer_id', $user->id)->get();
                }

                return DataTables::of($events)
                    ->addIndexColumn()
                    ->editColumn('created_at', function($event) {
                        return $event->created_at->format('Y-m-d H:i:s');
                    })
                    ->addColumn('actions', function($event) use ($user) {
                        return View::make('events.action', compact('event', 'user'))->render();
                    })
                    ->rawColumns(['actions', 'date', 'created_at'])
                    ->make(true);
            });
		}

        return view('events.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.createOrEdit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $event = new Event($request->except('_token'));
        $event->organizer_id = Auth::id();
        $event->save();

        return response()->json([
            'success' => true,
            'message' => 'Event added successfully.',
            'redirect' => route('events.index')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $ticketTypes = TicketType::get();

        return view('events.show', compact('event', 'ticketTypes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('events.createOrEdit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $event->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Event updated successfully.',
            'redirect' => route('events.index')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }

    /**
     * Add comment or ask questions.
     */
    public function comment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);
        
        $eventId = decrypt($id);

        $event = Event::findOrFail($eventId);
        
        $event->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        return redirect()->route('events.show', $eventId)->with('success', 'Comment added successfully.');
    }
}
