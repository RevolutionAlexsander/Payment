<?php

namespace App\ApiModels;

use Illuminate\Database\Eloquent\Model;

class TypeAccount extends Model
{
    protected $table = 'type_accounts';

    protected $fillable = [
        'name'
    ];

    public function applications(){
        return $this->hasMany(Application::class, 'type_account_id');
    }
}
