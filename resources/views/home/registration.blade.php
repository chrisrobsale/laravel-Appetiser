@extends('layouts.home')

@section('title', 'Registration Page')

@section('content')
<main class="form-signin" style = "max-width: 600px !important">
    
        <h4> Registration Page </h4>
        <form action="{{ route('home.register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="InputEmail" class="form-label">Email address</label>
                <input type="email" class="form-control" id="InputEmail" aria-describedby="emailHelp" placeholder="name@example.com" name="email">
            </div>
            <div class="mb-3">
                <label for="InputPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="InputPassword" placeholder="Password" name="password">
            </div>
            <div class="mb-3">
                <label for="InputRPassword" class="form-label">Repeat Password</label>
                <input type="password" class="form-control" id="InputRPassword" placeholder="Repeat Password" name="repeatPassword">
            </div>
            <div class="mb-3">
                <label for="InputName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="InputName" placeholder="Full Name" name="fullname">
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
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    
</main>
@endsection
