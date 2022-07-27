<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotifyEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $user;
    public $userRecives;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $userRecives, $message)
    {
        $this->user = $user;
        $this->userRecives = $userRecives;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('channel-notify');
    }

    public function broadcastWith()
    {
        return [
            'user' => $this->user,
            'recives' => $this->userRecives,
            'message' => $this->message,
        ];
    }
}
