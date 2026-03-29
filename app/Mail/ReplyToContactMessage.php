<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReplyToContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $contactName,
        public string $replyBody,
        public ?string $originalSubject,
        public string $originalMessage,
        public string $replyToEmail,
        public string $replyToName,
        public string $replyClosing,
    ) {}

    public function build(): self
    {
        $subject = $this->originalSubject
            ? 'Re: '.$this->originalSubject
            : 'Réponse — '.config('app.name');

        return $this->subject($subject)
            ->replyTo($this->replyToEmail, $this->replyToName)
            ->view('emails.reply-to-contact');
    }
}
