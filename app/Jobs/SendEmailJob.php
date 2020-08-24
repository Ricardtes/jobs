<?php

namespace App\Jobs;

use App\Mail\EmailToPersons;
use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $message;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        foreach ($this->message->messageRecipients as $item){
            $splitString = explode("\\", $item->mes_rec_type);
            if(strtolower($splitString[2]) == 'student'){
                $person = $item->student;
            } else{
                $person = $item->teacher;
            }
            Mail::to($person->email)->send(new EmailToPersons($this->message));
        }


    }
}
