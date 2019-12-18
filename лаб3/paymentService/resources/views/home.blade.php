@extends('layouts.app')

@section('content')
    @if(\Illuminate\Support\Facades\Auth::id() == 1)
        <application token={{\Illuminate\Support\Facades\Auth::user()->api_token}}></application>
    @else
        <account token={{\Illuminate\Support\Facades\Auth::user()->api_token}}></account>
{{--        <router-view to=/application/add" exact></router-view>--}}
    @endif
    <router-view></router-view>
@endsection
