<?php

namespace App\ApiModels;

use Illuminate\Database\Eloquent\Model;

class TypeApplication extends Model
{
    protected $table = 'type_applications';

    protected $fillable = [
        'name'
    ];

    public function applications(){
        return $this->hasMany(Application::class, 'type_application_id');
    }
}
