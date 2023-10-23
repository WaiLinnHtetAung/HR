@extends('auth.app')
@section('title', 'Login')
@section('content')
    <div class="login">
        <form action="{{ route('login.option') }}" method="get">
            @csrf
            <div class="logo d-flex justify-content-center">
                <img src="{{ asset('logo.png') }}" alt="">
            </div>
            <div class="card p-4 p-sm-5">
                <h2 class="text-center mb-4 font-bold">Login</h2>
                <div class="form-group mb-4">
                    <input type="email" name="email"
                        class="login-input w-100 border-0 border-bottom text-center login-input" autofocus
                        placeholder="Enter you email" required value="{{ old('email', '') }}">
                    @error('email')
                        <span class="text-danger text-center">{{ $message }}</span>
                    @enderror
                </div>

                <button class="btn w-100 mb-4">Continue</button>

                {{-- <p class="text-center mb-0 pb-0">New user ? <a href="{{ route('register') }}">Register</a></p> --}}
            </div>
        </form>
    </div>
@endsection
