<?php

namespace App\Http\Resources\Scheme;

use Illuminate\Http\Resources\Json\JsonResource;

class SchemeResource extends JsonResource
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
            "schemeName"=>$this->scheme_name,
            "startDate"=>$this->scheme_start_date,
            "endDate"=>$this->scheme_end_date,
        ];
    }
}
