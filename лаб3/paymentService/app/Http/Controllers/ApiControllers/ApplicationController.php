<?php

namespace App\Http\Controllers\ApiControllers;

use App\ApiModels\Account;
use App\ApiModels\Application;
use App\ApiModels\TypeAccount;
use App\ApiModels\TypeApplication;
use App\ApiModels\TypeCredit;
use App\ApiModels\User;
use App\Http\Requests\AddApplicationRequest;
use App\Http\Requests\ApprovalApplicationRequest;
use App\Http\Resources\ApplicationResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class ApplicationController extends Controller
{
    public function addApplication(AddApplicationRequest $request)
    {
        $user = User::where('api_token', $request->api_token)
            ->first();

        $data = [
            'income' => $request->income,
            'place_job' => $request->place_job,
            'resident_address' => $request->resident_address,
            'type_account_id' => $request->type_account_id,
            'type_credit_id' => null,
            'type_application_id' => null,
            'user_id' => $user->id,
        ];

        if ($request->type_credit_id != null) {
            $data['type_credit_id'] = $request->type_credit_id;
        }
        $application = Application::create($data);
        return $application;
    }

    public function getCredit(){
        $typeCredit = TypeCredit::all();
        return $typeCredit;
    }

    public function getAccount(){
        $typeAccount = TypeAccount::all();
        return $typeAccount;
    }

    public function Application(){
        return view('application');
    }

    public function all()
    {
        $application = Application::whereNull('type_application_id')
            ->with('typeAccount', 'typeApplication', 'typeCredit', 'user')
            ->get();
        return ApplicationResource::collection($application);
    }

    public function approvalApplication(ApprovalApplicationRequest $request)
    {
        if($request->approval == false){
            Application::where('id', $request->id)
                ->update(['type_application_id' => 2]);
        }else{
            Application::where('id', $request->id)
                ->update(['type_application_id' => 1]);
            $application = Application::where('id', $request->id)
                ->with('typeCredit')
                ->first();
            $data = [
                'number_account' => uniqid().rand(1000, 9999),
                'frozen' => false,
                'debt' => 0,
                'balance' => 100000,
                'date_opening' => Carbon::now(),
                'date_closing' => Carbon::now()->addYears(3),
                'type_credit_id' => $application['type_credit_id'],
                'user_id' => $application['user_id'],
            ];
            if($application->type_account_id == 2){
                $data['balance'] = $application->typeCredit->limit;
            }
            $account = Account::create($data);
        }
    }
}
