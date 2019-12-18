<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
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
            'id' => $this->id,
            'user' => $this->user['name'],
            'place_job' => $this->place_job,
            'income' => $this->income,
            'resident_address' => $this->resident_address,
            'type_account' => $this->typeAccount['name'],
            'type_credit' => $this->typeCredit['name'],
        ];
    }
}
