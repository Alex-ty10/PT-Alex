<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class CiudadCreadaMailable extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('jaramillor03@gmail.com', 'Alex Jaramillo'),
            subject: '¡Tu ciudad ha sido creada!',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.creada', 
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

