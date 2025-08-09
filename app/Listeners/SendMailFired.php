<?php

namespace App\Listeners;

use App\Events\SendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;


class SendMailFired
{
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
     * @param  \App\Events\SendMail  $event
     * @return void
     */
    public function handle(SendMail $event)
    {
        $data["email"] = $event->partner->email;
        $data["title"] = $event->owner->name. ' ' . $event->title;
        $data["body"] = $event->owner->name.' ' . $event->text;
        $data["ugyfel"] = $event->owner->name;
        $data["datum"] = date('Y-m-d');

        $files = [
            $event->path,
        ];

        Mail::send($event->mail, $data, function($message) use($data, $files) {
            $message->to($data["email"], $data["email"])
                ->subject($data["title"]);

            foreach ($files as $file){
                $message->attach($file);
            }
        });
    }
}


