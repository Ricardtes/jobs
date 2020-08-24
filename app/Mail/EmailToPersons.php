<?php

namespace App\Mail;

use App\Services\Traits\MessageTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;

class EmailToPersons extends Mailable
{
    use MessageTrait;
    use Queueable, SerializesModels;

    public $message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $body = File::get($this->fullPathToHtmlFile($this->message->body));

        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->subject($this->message->subject)
            ->view('mails.send', ['body'=> $body]);
    }
}
