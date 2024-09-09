<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;
use Illuminate\Broadcasting\InteractsWithSockets;

class MessageSent implements ShouldBroadcast
{
    use InteractsWithSockets,Dispatchable, SerializesModels;
    public $message;
    public function __construct(Message $message)
    {
        $this->message = $message;
    }
    
    public function broadcastOn()
    {
        return new Channel('chat.' . $this->message->chat_id);
    }
    


}
