<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $messageContent;

    /**
     * Create a new message instance.
     */
    public function __construct($messageContent)
    {
        $this->messageContent = $messageContent; // Simpan sebagai string
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Notifikasi Baru')
                    ->view('emails.notification')
                    ->with(['messageContent' => $this->messageContent]); // Gunakan key yang benar
    }
}
