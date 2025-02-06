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
        color: #ffffff; /* Set heading text color */
        background-color: transparent; /* No background color */
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
            {{ __('Reset Your Password') }}
        </div>
        <div class="subheader-text">
            {{ __('Enter your new password below to reset your account password.') }}
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input id="email"
                           type="email"
                           name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $request->email) }}"
                           required
                           autofocus
                           autocomplete="username">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group mt-4">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password"
                           type="password"
                           name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           required
                           autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group mt-4">
                    <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                    <input id="password_confirmation"
                           type="password"
                           name="password_confirmation"
                           class="form-control @error('password_confirmation') is-invalid @enderror"
                           required
                           autocomplete="new-password">
                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="kt-login__actions mt-4">
                    <center><button type="submit" class="btn btn-primary btn-elevate kt-login__btn-primary">
                        {{ __('Reset Password') }}
                    </button></center>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
