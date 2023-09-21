<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMail
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $partner;
    public $owner;
    public $path;
    public $mail;
    public $title;
    public $text;

    public function __construct($partner, $owner, $path, $mail, $title, $text)
    {
        $this->partner = $partner;
        $this->owner = $owner;
        $this->path = $path;
        $this->mail = $mail;
        $this->title = $title;
        $this->text = $text;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
