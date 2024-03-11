<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Stevebauman\Purify\Facades\Purify;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category' => $this->Category,
            'level' => $this->Level,
            'name' => Purify::clean($this->name),
            'describes' => Purify::clean($this->describes),
            'project' => $this->Project,
            'priority' => $this->Priority,
            'user' => UserTaskResource::collection($this->UserTask),
            'start_time' => Carbon::parse($this->start_time)->timestamp,
            'estimate_time' => Carbon::parse($this->estimate_time)->timestamp,
            'created_at' => Carbon::parse($this->created_at)->timestamp,
            'updated_at' => Carbon::parse($this->updated_at)->timestamp,
        ];
    }
}
