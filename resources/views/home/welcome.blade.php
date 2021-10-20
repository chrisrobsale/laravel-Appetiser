@extends('layouts.home')

@section('title', 'Welcome Page')

@section('content')
<div class="container welcomeMsg">
    <div class="row">
        <h1> Welcome to Appetiser App! </h1>
        <a href="{{ route('home.userLogout') }}">Logout</a>
    </div>
</div>

@endsection
