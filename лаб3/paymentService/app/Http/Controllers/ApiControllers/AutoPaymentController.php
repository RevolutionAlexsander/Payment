<?php

namespace App\Http\Controllers\ApiControllers;

use App\ApiModels\Account;
use App\ApiModels\Autopayment;
use App\ApiModels\Payment;
use App\ApiModels\TypeAutoPayment;
use App\Http\Requests\AddAutoPaymentRequest;
use App\Http\Requests\FrozenAutoPaymentRequest;
use App\Http\Resources\AutoPaymentResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AutoPaymentController extends Controller
{
    public function all()
    {
        $payment = Autopayment::with(['senderAP' => function($query){
            $query->where('user_id', Auth::id());
        },
            'recipientAP',
            'typeAP'])
            ->get();
        return AutoPaymentResource::collection($payment);
    }

    public function AutoPayment(){
        return view('autopayment');
    }

    public function addAuto(){
        return view('addautopayment');
    }

    public function getAccount()
    {
        $accounts = Account::where([
            ['user_id', Auth::id()],
            ['frozen', false]
        ])
            ->with('typeCredit')
            ->get();
        return $accounts;
    }

    public function getType()
    {
        $type = TypeAutoPayment::all();
        return $type;
    }

    public function frozenAutoPayment(FrozenAutoPaymentRequest $request)
    {
        Autopayment::where('id', $request->id)
            ->update(['frozen' => true]);
    }

    public function noFrozenAutoPayment(FrozenAutoPaymentRequest $request)
    {
        Autopayment::where('id', $request->id)
            ->update(['frozen' => false]);
    }

    public function addAutoPayment(AddAutoPaymentRequest $request)
    {
        $recipient_account = Account::where('number_account', $request->number_account)
            ->first();

        $data = [
            'sender_id' => $request->sender_id,
            'recipient_id' => $recipient_account->id,
            'sum' => $request->transactions,
            'date' => Carbon::now(),
            'frozen' => false,
            'type_autopayment_id' => $request->type_autopayment_id,
        ];
        $payment = Autopayment::create($data);
        return $payment;
    }
}
