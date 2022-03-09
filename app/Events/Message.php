<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Message implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

        public $username;
        public $message;
    public function __construct($username,$message)
    {        
        $this->message=$message;
        $this->username=$username;
    }

    public function broadcastOn()
    {
        return ['chat'];
    }

    public function broadcastAs()
    {
        return 'message';
    }
    // public function broadcastOn()
    // {
    //     return new PrivateChannel('channel-name');
    // }
}
