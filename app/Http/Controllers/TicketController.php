<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use Stripe\Stripe;
use Stripe\PaymentIntent;

use App\Models\Event;
use App\Models\TicketType;
use App\Models\Ticket;

use App\Events\TicketPurchased;
use App\Mail\TicketConfirmation;

/**
 * Class TicketController
 *
 * This controller handles the ticket purchasing process, including creating tickets,
 * managing ticket quantities, and handling payment intents via Stripe.
 */
class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Method to display a list of tickets (not implemented).
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Method to show a form for creating a new ticket (not implemented).
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event $event
     */
    public function store(Request $request, Event $event)
    {
        // Method to store a newly created ticket in storage (not implemented).
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function show(string $id)
    {
        $ticketTypes = TicketType::all();
        return view('events.purchase', compact('event', 'ticketTypes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $id
     */
    public function edit(string $id)
    {
        // Method to show a form for editing the specified ticket (not implemented).
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id
     */
    public function update(Request $request, string $id)
    {
        // Method to update the specified ticket in storage (not implemented).
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     */
    public function destroy(string $id)
    {
        // Method to remove the specified ticket from storage (not implemented).
    }

    /**
     * Show the form for purchasing tickets for the given event.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\View\View
     */
    public function showPurchaseForm(Event $event)
    {
        $ticketTypes = TicketType::all();
        return view('tickets.purchase', compact('event', 'ticketTypes'));
    }

    /**
     * Handle the ticket purchasing process.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\JsonResponse
     */
    public function purchaseTicket(Request $request, Event $event)
    {
        try {
            // Validate request
            $request->validate([
                'ticket_type_id' => 'required|exists:ticket_types,id',
                'quantity' => 'required|integer|min:1',
            ]);

            $ticketType = TicketType::findOrFail($request->ticket_type_id);

            // Create the tickets
            $this->createTickets($event, $ticketType, $request->quantity);

            // Reduce available quantity of the ticket type
            $ticketType->quantity -= $request->quantity;
            $ticketType->save();

            // Send email confirmation
            try {
                Mail::to(\Auth::user()->email)->send(new TicketConfirmation([
                    'title' => $event->title,
                    'quantity' => $request->quantity,
                    'name' => $ticketType->name
                ]));
            } catch(\Exception $emailException) {
                \Log::error('Email sending failed: ' . $emailException->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => 'Ticket purchased successfully.'
            ]);
        } catch(\Exception $e) {
            \Log::error('Ticket purchase failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while purchasing the ticket.'
            ], 500);
        }
    }

    /**
     * Create a Stripe payment intent for the given event.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\JsonResponse
     */
    public function createPaymentIntent(Request $request, Event $event)
    {
        Stripe::setApiKey(config('stripe.secret'));

        $ticketType = TicketType::findOrFail($request->ticket_type_id);

        // Check ticket availability
        if ($ticketType->quantity < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Not enough tickets available.'
            ]);
        }

        $paymentIntent = PaymentIntent::create([
            'amount' => $request->amount * 100,
            'currency' => 'usd',
        ]);

        return response()->json(['client_secret' => $paymentIntent->client_secret]);
    }

    /**
     * Create tickets for the specified event and ticket type.
     *
     * @param \App\Models\Event $event
     * @param \App\Models\TicketType $ticketType
     * @param int $quantity
     */
    protected function createTickets($event, $ticketType, $quantity)
    {
        $tickets = [];

        for ($i = 1; $i <= $quantity; $i++) {
            $tickets[] = [
                'event_id' => $event->id,
                'user_id' => \Auth::id(),
                'ticket_type_id' => $ticketType->id,
                'ticket_code' => 'T' . uniqid(),
                'is_sold' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Trigger the TicketPurchased event
        event(new TicketPurchased($tickets[0]));

        // Insert tickets into the database
        Ticket::insert($tickets);
    }
}