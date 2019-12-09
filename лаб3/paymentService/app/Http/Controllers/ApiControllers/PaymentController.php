<?php

namespace App\Http\Controllers\ApiControllers;

use App\ApiModels\Account;
use App\ApiModels\Payment;
use App\ApiModels\User;
use App\Http\Requests\AddPaymentRequest;
use App\Http\Resources\PaymentResource;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function historyPayment()
    {
        $payment = Payment::with(['sender' => function($query){
            $query->where('user_id', Auth::id());
        },
            'recipient'])
            ->get();
        return PaymentResource::collection($payment);
    }

    public function getAddPayment()
    {
        $accounts = Account::where(['user_id', Auth::id()], ['frozen', false])
            ->with('typeCredit')
            ->get();
        return $accounts;
    }

    public function addPayment(AddPaymentRequest $request)
    {
        $recipient_account = Account::where('number_account', $request->number_account)
            ->first();

        $data = [
            'sender_id' => $request->sender_id,
            'recipient_id' => $recipient_account->id,
            'sum' => $request->transactions,
            'date' => Carbon::now(),
        ];
        $payment = Payment::create($data);
        $account = Account::where('id', $request->sender_id)
            ->with('typeCredit')
            ->first();
        if (!$account->type_credit_id) {
            $ost = $account->balance - $request->transactions;
            Account::where('id', $account->id)
                ->update(['balance' => $ost]);
            Account::where('id', $recipient_account->id)
                ->update(['balance' => $account->balance + $request->transactions]);
        } else {
            $percent = $account->typeCredit->percent;
            $debt = $request->transactions + $request->transactions * ($percent / 100);
            $ost = $account->balance - $request->transactions;
            Account::where('id', $account->id)
                ->update(['balance' => $ost], ['debt' => $debt]);
            Account::where('id', $recipient_account->id)
                ->update(['balance' => $account->balance + $request->transactions]);
        }
        return $payment;
    }
}
