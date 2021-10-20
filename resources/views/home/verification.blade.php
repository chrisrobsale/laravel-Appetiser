@extends('layouts.home')

@section('title', 'Verification Page')

@section('content')
<main class="form-signin">
    <form action="{{ route('home.verify') }}" method="POST">
        @csrf
        <h5>Please enter the verification code sent to your email.</h5>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" placeholder="****" name="verifyCode">
            <label for="floatingInput">Verification Code</label>
        </div>
        <button class="w-100 btn btn-md btn-primary" type="submit">Verify Account</button>
        
    </form>
</main>
@endsection
