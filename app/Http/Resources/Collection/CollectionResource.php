<?php

namespace App\Http\Resources\Collection;

use Illuminate\Http\Resources\Json\JsonResource;

class CollectionResource extends JsonResource
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
            "collection_total_due"=>$this->collection_total_due,
            "collection_balance_due"=>$this->collection_total_due,
            "updated_at"=>$this->updated_at->format('d-m-y'),
        ];
    }
}
