<?php

namespace App\ApiModels;

use Illuminate\Database\Eloquent\Model;

class Autopayment extends Model
{
    protected $table = 'autopayments';

    protected $fillable = [
        'sender_id',
        'recipient_id',
        'sum',
        'date',
        'frozen',
        'type_autopayment_id'
    ];

    public function senderAP(){
        return $this->belongsTo(Account::class, 'sender_id');
    }

    public function recipientAP(){
        return $this->belongsTo(Account::class, 'recipient_id');
    }

    public function typeAP(){
        return $this->belongsTo(TypeAutoPayment::class, 'type_autopayment_id');
    }
}
