<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Ticket;

/**
 * Class TicketConfirmation
 *
 * This Mailable class is responsible for sending a confirmation email to the user
 * after a ticket purchase. It includes the details of the purchased ticket.
 */
class TicketConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The ticket data to be included in the email.
     *
     * @var array
     */
    public $ticket;

    /**
     * Create a new message instance.
     *
     * @param array $data The ticket data to be included in the email.
     */
    public function __construct($data)
    {
        $this->ticket = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Ticket Purchase Confirmation')
            ->view('emails.ticket_confirmation');
    }
}
?>