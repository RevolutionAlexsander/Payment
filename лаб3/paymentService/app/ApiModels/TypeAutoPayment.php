<?php

namespace App\ApiModels;

use Illuminate\Database\Eloquent\Model;

class TypeAutoPayment extends Model
{
    protected $table = 'type_autopayments';

    protected $fillable = [
        'name',
        'number',
    ];

    public function typesAP(){
        return $this->belongsTo(Autopayment::class, 'type_autopayment_id');
    }
}
