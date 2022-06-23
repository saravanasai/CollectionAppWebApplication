<?php

namespace App\Http\Resources\Transaction;

use App\Http\Resources\Customer\CustomerResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            "transactionId"=>$this->id,
            "transactionAmount"=>$this->transaction_amount,
            "paid_to"=> UserResource::make($this->whenLoaded('User')),
            "customer"=> CustomerResource::make($this->whenLoaded('Customer')),
            "created_at"=>$this->created_at->format('d-m-Y'),
        ];
    }
}
