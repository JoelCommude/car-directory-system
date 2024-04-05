<?php

namespace App\Http\Resources;

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
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'company_id' => $this->company_id,
            'car_id' => $this->car_id,
            'plate_number' => $this->plate_number,
            'engine_number' => $this->engine_number,
            'fuel_id' => $this->fuel_id,
            'body_id' => $this->body_id,
            'register_date' => $this->created_at->format('Y-m-d h:i a'),
            'company' => $this->company,
            'users' => $this->user,
            'car' => $this->car,
            'fuel' => $this->fuel,
            'body' => $this->body
        ];
    }
}
