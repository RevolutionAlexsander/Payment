<?php

namespace App\ApiModels;

use Illuminate\Database\Eloquent\Model;

class TypeCredit extends Model
{
    protected $table = 'type_credits';

    protected $fillable = [
        'name',
        'condition',
        'percent',
        'limit',
    ];

    public function accounts(){
        return $this->hasMany(Account::class, 'type_credit_id');
    }

    public function applications(){
        return $this->hasMany(Application::class, 'type_credit_id');
    }
}
