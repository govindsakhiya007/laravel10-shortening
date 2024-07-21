<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ticket
 *
 * This model represents a ticket associated with an event, user, and ticket type.
 * It includes relationships with events, users, and ticket types.
 */
class Ticket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_id',
        'user_id',
        'ticket_type_id',
        'ticket_code', 
        'is_sold'
    ];

    /**
     * Get the event associated with the ticket.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    /**
     * Get the user who owns the ticket.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->select(['id', 'name', 'email']);
    }

    /**
     * Get the ticket type associated with the ticket.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticketType()
    {
        return $this->belongsTo(TicketType::class, 'ticket_type_id');
    }
}