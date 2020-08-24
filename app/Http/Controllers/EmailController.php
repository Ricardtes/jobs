<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Jobs\SendEmailJob;

class EmailController extends Controller
{
    public function send($messageId)
    {
        $message = Message::find($messageId);
        SendEmailJob::dispatch($message);
        $message->update(['sent'=> true]);
        session()->flash('success',  'Message has been sent.');

        return redirect()->back();
    }
}
