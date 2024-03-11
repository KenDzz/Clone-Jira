<?php

namespace App\Events;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewTaskEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $task;

    private $userId;

   public function __construct(Task $task, $id)
   {
       $this->task = $task;
       $this->userId = $id;
   }

   /**
    * Get the channels the event should broadcast on.
    *
    * @return \Illuminate\Broadcasting\Channel|array
    */
   public function broadcastOn(): array
   {
       return [
           new PrivateChannel("user.".$this->userId), //create channel
       ];
   }

   public function broadcastWith(): array
    {
        return [
            'task' => new TaskResource($this->task),
        ];
    }
}
