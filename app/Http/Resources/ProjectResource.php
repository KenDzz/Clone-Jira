<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\DateHelper;
use Carbon\Carbon;
use Stevebauman\Purify\Facades\Purify;

class ProjectResource extends JsonResource
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
            'name' => $this->name,
            'describes' => Purify::clean($this->describes),
            'status' => $this->status,
            'created_at' => Carbon::parse($this->created_at)->timestamp,
            'updated_at' => Carbon::parse($this->updated_at)->timestamp,
            'member' => $this->userProjects,
        ];
    }
}
