<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'client' => new ClientResource($this->whenLoaded('client')),
            'project_status' => new ProjectStatusResource($this->whenLoaded('projectStatus')),
            'description' => $this->when($this->description !== null, $this->description),
            'completed_at' => $this->completed_at
        ];
    }
}
