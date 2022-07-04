<?php

namespace App\Http\Resources\Agent;

use App\Http\Resources\Location\LocationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AgentResource extends JsonResource
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
            "id" => $this->id,
            "agentId" => $this->agent_id,
            "agentName" => $this->agent_name,
            "agentPhone" => $this->agent_phone,
            "agentLocationId" => $this->agent_location_id,
            "agentLocation" =>LocationResource::make($this->whenLoaded('Location')),
        ];
    }
}
