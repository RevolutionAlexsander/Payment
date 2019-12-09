<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
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
            'number_account' => $this->number_account,
            'debt' => $this->debt,
            'balance' => $this->balance,
            'date_opening' => $this->date_opening,
            'date_closing' => $this->date_closing,
            'type_credit' => $this->typeCredit['name'],
        ];
    }
}
