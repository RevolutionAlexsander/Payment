<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'sender' => $this->sender['number_account'],
            'recipient' => $this->recipient['number_account'],
            'sum' => $this->sum,
            'date' => $this->date
        ];
    }
}
