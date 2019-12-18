@extends('layouts.app')

@section('content')
    <addapplication  token={{\Illuminate\Support\Facades\Auth::user()->api_token}}></addapplication>
    <router-view></router-view>
@endsection
