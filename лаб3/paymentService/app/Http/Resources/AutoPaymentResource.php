<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AutoPaymentResource extends JsonResource
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
            'sender' => $this->senderAP['number_account'],
            'recipient' => $this->recipientAP['number_account'],
            'sum' => $this->sum,
            'date' => $this->date,
            'type_autopayment' => $this->typeAP['name'],
        ];
    }
}
