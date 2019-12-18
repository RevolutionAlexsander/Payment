@extends('layouts.app')

@section('content')
    <payment-auto-add  token={{\Illuminate\Support\Facades\Auth::user()->api_token}}></payment-auto-add>
    <router-view></router-view>
@endsection
