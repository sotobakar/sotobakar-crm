<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'client_status' => new ClientStatusResource($this->whenLoaded('clientStatus')),
            'client_type' => new ClientTypeResource($this->whenLoaded('clientType')),
            'title' => $this->title,
            'address' => $this->address,
            'description' => $this->description,
            'image' => $this->getFirstMediaUrl('client') ?: null,
        ];
    }
}
