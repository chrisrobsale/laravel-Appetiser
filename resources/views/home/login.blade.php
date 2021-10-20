@extends('layouts.home')

@section('title', 'Login Page')

@section('content')
<main class="form-signin text-center">
    <form action="{{ route('home.userLogin') }}" method="POST">
        @csrf
        <h1 class="mb-3 fw-bold">Appetiser App</h1>
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
  
        <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username">
            <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
            <label for="floatingPassword">Password</label>
        </div>
        
        @if($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <p class="fs-6 mt-3 fw-light"> Not Registered yet? <a href="{{ route('home.registration') }}" class="fw-bold text-primary"> Create an Account </a> </p>
        
    </form>
</main>
@endsection
