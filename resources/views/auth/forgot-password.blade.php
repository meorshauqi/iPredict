@extends('layouts.app')

@section('content')
<style>
    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
    }

    .full-screen-background {
        background-image: url('{{ asset('adminpanel/assets/media/bg/login.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
    }

    .card {
        background-color: rgba(37, 37, 30, 0.9);
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(255, 255, 255, 0.2);
        padding: 20px;
        width: 100%;
        max-width: 500px;
    }

    .card-header {
        font-weight: bold;
        color: #ffffff; /* Set heading "Register" text color to black */
        background-color: transparent; /* Optional: No background color */
        text-align: center;
    }

    .form-label {
        color: #fff; /* Make form labels white */
    }

    .btn-primary {
        background-color: #007bff; /* Button color */
        border-color: #007bff;
    }

    .subheader-text {
        color: #fff;
        text-align: center;
        margin-top: 10px;
        margin-bottom: 20px;
    }
</style>

<div class="full-screen-background">
    <div class="card">
        <div class="card-header text-center" style="font-weight: bold;">
            {{ __('Forgot your password?') }}
        </div>
        <div class="subheader-text">
            {{ __('Enter your email and we\'ll send you a link to get back into your account') }}
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('password.email') }}" class="kt-form">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <input id="email"
                           type="email"
                           name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="Email"
                           value="{{ old('email') }}"
                           required
                           autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="kt-login__actions">
                    <center><button type="submit" class="btn btn-primary btn-elevate kt-login__btn-primary">
                        {{ __('Email Password Reset Link') }}
                    </button></center>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
