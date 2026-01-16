<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public function __construct(
        public $user
    ) {}

    public function build()
    {
        return $this->subject('Ваши данные были обновлены')
            ->view('mails.profiles.update', ['user' => $this->user]);
    }
}
