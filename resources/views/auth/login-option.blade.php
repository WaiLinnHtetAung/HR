@extends('auth.app')
@section('title', 'Login Option')
@section('content')
    <div class="login">
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="logo d-flex justify-content-center">
                <img src="{{ asset('logo.png') }}" alt="">
            </div>
            <div class="card p-4 p-sm-5">
                <h2 class="text-center mb-4 font-bold">Login Option</h2>

                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                        <strong>{{ $error }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach

                <ul class="nav nav-pills my-3 text-center" id="pills-tab" role="tablist">
                    <li class="nav-item w-50 my-3" role="presentation">
                        <button class="nav-link w-100 active" id="pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                            aria-selected="true">Password</button>
                    </li>
                    <li class="nav-item w-50 my-3" role="presentation">
                        <button class="nav-link w-100" id="pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                            aria-selected="false">Biometric</button>
                    </li>
                </ul>
                <div class="tab-content my-5" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <input type="password" placeholder="Enter you password"
                            class="w-100 border-0 border-bottom text-center login-input" autofocus name="password">

                        <input type="hidden" name="email" value="{{ $email }}">
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...
                    </div>

                </div>


                <button class="btn w-100 my-4">Login</button>

                {{-- <p class="text-center mb-0 pb-0">New user ? <a href="{{ route('register') }}">Register</a></p> --}}
            </div>
        </form>
    </div>
@endsection
