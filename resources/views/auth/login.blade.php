@extends('layouts.app')

@section('content')
<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
    <div class="kt-grid kt-grid--hor kt-grid--root kt-login kt-login--v1" id="kt_login">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">
            <!-- Left Side: Background Image -->
            <div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside" style="background-image: url('{{ asset('adminpanel/assets/media/bg/login3.jpg') }}');">
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">
                    <div class="kt-grid__item kt-grid__item--middle">
                        <h3 class="kt-login__title">Welcome to Our Health Management System!</h3>
                        <h4 class="kt-login__subtitle">Providing a convenient way to manage your health online.</h4>
                    </div>
                </div>
                <div class="kt-grid__item">
                    <div class="kt-login__info">
                        <div class="kt-login__copyright">
                            &copy; 2024 iPredict
                        </div>
                        <div class="kt-login__menu">
                            <a href="#" class="kt-link">Privacy</a>
                            <a href="#" class="kt-link">Legal</a>
                            <a href="#" class="kt-link">Contact</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Login Form -->
            <div class="kt-grid__item kt-grid__item--fluid kt-grid__item--order-tablet-and-mobile-1 kt-login__wrapper" style="background-image: url('{{ asset('adminpanel/assets/media/bg/bg-3.jpg') }}');">
                <div class="kt-login__head">
                    <span class="kt-login__signup-label">Don't have an account yet?</span>&nbsp;&nbsp;
                    <a href="{{ route('register') }}" class="kt-link kt-login__signup-link">Sign Up!</a>
                </div>

                <div class="kt-login__body">
                    <div class="kt-login__form">
                        <div class="kt-login__title">
                            <h1>Sign In</h1>
                        </div>

                        <!-- Session Status -->
                        @if (session('status'))
                            <div class="alert alert-success mb-4">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" class="kt-form">
                            @csrf
                            <div class="form-group">
                                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            {{-- <div class="form-group">
                                <label for="remember_me" class="kt-checkbox">
                                    <input id="remember_me" type="checkbox" name="remember"> Remember Me
                                    <span></span>
                                </label>
                            </div> --}}

                            <div class="kt-login__actions">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="kt-link kt-login__link-forgot">Forgot Password?</a>
                                @endif
                                <button type="submit" class="btn btn-primary btn-elevate kt-login__btn-primary">Sign In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
