@extends('layouts.app')

@section('content')
    <payment token={{\Illuminate\Support\Facades\Auth::user()->api_token}}></payment>
    <router-view></router-view>
@endsection
