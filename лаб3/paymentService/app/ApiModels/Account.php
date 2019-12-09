<?php

namespace App\ApiModels;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'accounts';

    protected $fillable = [
        'number_account',
        'frozen',
        'debt',
        'balance',
        'date_opening',
        'date_closing',
        'type_credit_id',
        'user_id',
    ];

    public function typeCredit(){
        return $this->belongsTo(TypeCredit::class, 'type_credit_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function senders(){
        return $this->hasMany(Payment::class, 'sender_id');
    }

    public function recipients(){
        return $this->hasMany(Payment::class, 'recipient_id');
    }

    public function sendersAP(){
        return $this->hasMany(Autopayment::class, 'sender_id');
    }

    public function recipientsAP(){
        return $this->hasMany(Autopayment::class, 'recipient_id');
    }
}
