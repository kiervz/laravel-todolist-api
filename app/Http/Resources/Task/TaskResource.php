<?php

namespace App\Http\Resources\Task;

use App\Http\Resources\Label\LabelResource;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'label' => new LabelResource($this->label),
            'title' => $this->title,
            'is_complete' => $this->is_complete
        ];
    }
}
