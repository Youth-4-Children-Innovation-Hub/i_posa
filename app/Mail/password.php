<?php

namespace App\Mail;

use Illuminate\Mail\Mailables\Address;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class password extends Mailable
{
    use Queueable, SerializesModels;

    private $password;
    private $name;
    /**
     * Create a new message instance.
     */
    public function __construct($password,$name)
    {
        
        $this->password=$password;
        $this->name=$name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('iposaauthentication@gmail.com', 'SuperAdmn'),
            subject: 'Your New Password for IPOSA',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.password',
            with: [
                'name' => $this->name,
                'password' => $this->password,
            ],
            
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}