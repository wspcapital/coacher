<?php

namespace App\Events;

use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewPortalMessageEvent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Chat $message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return ['chat'];
        //return new PrivateChannel('channel-name');
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message,
            'author' => $this->message->userAuthor,
            'addressee' => $this->message->userAddressee
        ];
    }

    public function broadcastAs()
    {
        // return 'message' . $this->message->addressee;
        return 'message' . $this->message->author;
    }
}
