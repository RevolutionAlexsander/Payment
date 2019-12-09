<?php

namespace App\Http\Controllers\ApiControllers;

use App\ApiModels\Account;
use App\ApiModels\Autopayment;
use App\ApiModels\Payment;
use App\Http\Resources\AccountResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function all()
    {
        $payments = Autopayment::with('senderAP', 'recipientAP', 'typeAP')
            ->whereHas('senderAP', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get();
        $start = Carbon::now()->startOfDay();
        $finish = Carbon::now()->endOfDay();
        if ($payments->count() > 0) {
            foreach ($payments as $payment){
                if($start < $payment->date && $payment->date < $finish){
                    $data = [
                        'sender_id' => $payment->sender_id,
                        'recipient_id' => $payment->recipient_id,
                        'sum' => $payment->sum,
                        'date' => Carbon::now(),
                    ];
                    $payment = Payment::create($data);
                    $account = Account::where('id', $payment->sender_id)
                        ->with('typeCredit')
                        ->first();
                    $ost = $account->balance - $payment->transactions;
                    Account::where('id', $account->id)
                        ->update(['balance' => $ost]);
                    Account::where('id', $payment->recipient_id)
                        ->update(['balance' => $account->balance + $payment->transactions]);

                    $number = $payment->typeAP->number;
                    $date = new Carbon($payment['date']);
                    $date = $date->addDays($number);
                    Autopayment::where('id', $payment->id)
                        ->update(['date' => $date]);
                }
            }
        }
//dd(Auth::id());
        $accounts = Account::where([['user_id', Auth::id()], ['frozen', false]])
            ->with('user', 'typeCredit')
            ->get();
//dd($accounts);
        $balanceSum = 0;
        $balance = Account::with('user', 'typeCredit')
            ->where([['user_id', Auth::id()], ['frozen', false], ['type_credit_id', null]])
            ->get();
        if ($balance->count() > 0) {
            foreach ($balance as $v) {
                $balanceSum = +$v->balance;
            }
        }

        $flag = false;
        foreach ($accounts as $account) {
            if (Carbon::now() > $account->date_closing) {
                if ($account->type_credit_id == null) {
                    Account::where('id', $account->id)
                        ->update(['frozen' => true]);
                } else {
                    if ($account->debt > 0) {
                        if ($account->debt > $balanceSum) {
                            $flag = true;
                            break;
                        } else {
                            $this->Debt($account->debt, $account->id);
                            Account::where('id', $account->id)
                                ->update(['frozen' => true]);
                        }
                    }
                }
            }
        }
        if ($flag == true) {
            foreach ($accounts as $account) {
                Account::where('id', $account->id)
                    ->update(['frozen' => true]);
            }
        }

        $accountsNoFrozen = Account::with('user', 'typeCredit')
            ->where([['user_id', Auth::id()], ['frozen', false]])
            ->get();
        return AccountResource::collection($accountsNoFrozen);
    }

    public function Debt($debt, $id)
    {
        $balance = Account::with('user', 'typeCredit')
            ->where([['user_id', Auth::id()], ['frozen', false], ['type_credit_id', null], ['balance', '>', 0]])
            ->orderBy('balance', 'desc')
            ->first();
        $debtOst = $debt - $balance->balance;
        if ($debtOst > 0) {
            Account::where('id', $balance->id)
                ->update(['balance' => 0]);
            Account::where('id', $id)
                ->update(['balance' => $debtOst]);
            $this->Debt($debtOst, $id);
        } else {
            Account::where('id', $id)
                ->update(['balance' => 0]);
            Account::where('id', $id)
                ->update(['balance' => ($balance->balance - $debt)]);
        }
    }
}
