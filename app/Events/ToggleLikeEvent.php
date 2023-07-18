<?php

namespace App\Events;

use App\Http\Resources\LikeResource;
use App\Models\Like;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use PhpParser\Node\Scalar\String_;

class ToggleLikeEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public LikeResource $like;
    public bool $deleteLike;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($like, $delete)
    {
        $this->like = new LikeResource($like);
        $this->deleteLike = $delete;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('likes');
    }
}
