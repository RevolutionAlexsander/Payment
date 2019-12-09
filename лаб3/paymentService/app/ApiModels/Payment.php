<?php

namespace App\ApiModels;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'sender_id',
        'recipient_id',
        'sum',
        'date',
    ];

    public function sender(){
        return $this->belongsTo(Account::class, 'sender_id');
    }

    public function recipient(){
        return $this->belongsTo(Account::class, 'recipient_id');
    }
}
