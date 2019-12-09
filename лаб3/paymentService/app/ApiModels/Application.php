<?php

namespace App\ApiModels;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'applications';

    protected $fillable = [
        'income',
        'place_job',
        'resident_address',
        'type_account_id',
        'user_id',
        'type_application_id',
        'type_credit_id',
    ];

    public function typeAccount(){
        return $this->belongsTo(TypeAccount::class, 'type_account_id');
    }

    public function typeApplication(){
        return $this->belongsTo(TypeApplication::class, 'type_application_id');
    }

    public function typeCredit(){
        return $this->belongsTo(TypeCredit::class, 'type_credit_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
