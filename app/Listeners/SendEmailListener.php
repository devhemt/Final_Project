<?php

namespace App\Listeners;

use App\Mail\MailNotify;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\SendMailEvent;
use Illuminate\Support\Facades\Mail;

class SendEmailListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SendMailEvent  $event)
    {
        $data = $event->emailData;
        Mail::to($data['email'])->send(new MailNotify($data));
    }
}
