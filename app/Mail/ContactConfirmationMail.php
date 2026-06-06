<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Contact;

class ContactConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function build()
    {
        return $this->subject('Confirmação - Mensagem recebida - X7 Rural')
            ->view('emails.contact-confirmation')
            ->with([
                'contact' => $this->contact
            ]);
    }
}
