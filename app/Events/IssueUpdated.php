<?php

namespace App\Events;

use App\Issue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class IssueUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $issue;
    public $user;

    /**
     * Create a new event instance.
     *
     * @param  Issue $issue
     * @return void
     */
    public function __construct(Issue $issue)
    {
        $this->issue = $issue;
        if (Auth::check()) {
            $this->user = Auth::user();
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
