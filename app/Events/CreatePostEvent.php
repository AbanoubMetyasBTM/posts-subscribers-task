<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreatePostEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $postId;


    public function __construct(int $postId)
    {
        $this->postId = $postId;
    }

}
