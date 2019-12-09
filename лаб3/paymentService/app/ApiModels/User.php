<?php

namespace App\ApiModels;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'api_token',
    ];

    protected $hidden = [
        'password', 'api_token'
    ];

    public function accounts(){
        return $this->hasMany(Account::class, 'user_id');
    }

    public function applications(){
        return $this->hasMany(Application::class, 'user_id');
    }
}
