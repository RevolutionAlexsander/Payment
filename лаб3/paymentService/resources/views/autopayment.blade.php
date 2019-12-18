@extends('layouts.app')

@section('content')
    <payment-auto token={{\Illuminate\Support\Facades\Auth::user()->api_token}}></payment-auto>
    <router-view></router-view>
@endsection
