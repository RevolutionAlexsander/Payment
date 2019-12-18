@extends('layouts.app')

@section('content')
    <payment-add token={{\Illuminate\Support\Facades\Auth::user()->api_token}}></payment-add>
    <router-view></router-view>
@endsection
