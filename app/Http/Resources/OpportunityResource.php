<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OpportunityResource extends JsonResource
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
            'opportunity_status' => new OpportunityStatusResource($this->whenLoaded('opportunityStatus')),
            'description' => $this->description
        ];
    }
}
