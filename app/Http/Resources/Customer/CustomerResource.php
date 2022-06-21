<?php

namespace App\Http\Resources\Customer;

use App\Http\Resources\Agent\AgentResource;
use App\Http\Resources\Collection\CollectionResource;
use App\Http\Resources\Location\LocationResource;
use App\Http\Resources\Plan\PlanResource;
use App\Http\Resources\Scheme\SchemeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            "id"=>$this->id,
            "customerId"=>$this->customer_id,
            "firstName"=>$this->f_username,
            "secondName"=>$this->s_username,
            "primaryPhone"=>$this->primary_phone,
            "secondaryPhone"=>$this->secondary_phone,
            "locationId"=>$this->location_id,
            "agentId"=>$this->refered_agent_id,
            "location"=>LocationResource::make($this->whenLoaded('Location')),
            "plan"=>PlanResource::make($this->whenLoaded('Plan')),
            "agent"=>AgentResource::make($this->whenLoaded('Agent')),
            "collection"=>CollectionResource::make($this->whenLoaded('Collection')),
            "scheme"=>SchemeResource::make($this->whenLoaded('Scheme')),
            "complementOne"=>$this->complement_one,
            "complementTwo"=>$this->complement_two,
            "created_at"=>$this->created_at->format('d-m-Y'),
        ];
    }
}
