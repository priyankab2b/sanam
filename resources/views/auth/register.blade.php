@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <div class="d-flex">
                                    
                                    <input id="gender-m" type="radio"  value="male" class=" @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}" required autocomplete="gender">
                                    <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Male') }}</label>

                                    <input id="gender-f" type="radio" value="female" class=" @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}" required autocomplete="gender">
                                    <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Female') }}</label>
                                </div>

                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="age" class="col-md-4 col-form-label text-md-end">{{ __('Age') }}</label>

                            <div class="col-md-6">
                                <input id="age" type="text" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}" required autocomplete="age">

                                @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="profileimg" class="col-md-4 col-form-label text-md-end">{{ __('Profile image') }}</label>

                            <div class="col-md-6">
                                <input id="profileimg" type="file" class="form-control @error('profileimg') is-invalid @enderror" name="profileimg" value="{{ old('profileimg') }}" required autocomplete="profileimg">

                                @error('profileimg')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="gendeperferencer" class="col-md-4 col-form-label text-md-end">{{ __('Perference') }}</label>

                            <div class="col-md-6">
                                <div class="d-flex">
                                    
                                    <input id="perference-m" type="radio"  value="male" class=" @error('perference') is-invalid @enderror" name="perference" value="{{ old('perference') }}" required autocomplete="perference">
                                    <label for="perference" class="col-md-4 col-form-label text-md-end">{{ __('Male') }}</label>

                                    <input id="perference-f" type="radio" value="female" class=" @error('perference') is-invalid @enderror" name="perference" value="{{ old('perference') }}" required autocomplete="perference">
                                    <label for="perference" class="col-md-4 col-form-label text-md-end">{{ __('Female') }}</label>
                                </div>

                                @error('perference')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>


                    <div class="row mt-3">
                        <div class="col-md-6 offset-md-4">
                            <a class="g-signin2" href="{{ route('googlelogin') }}">Direct login with Google</a>
                            <!-- <div class="g-signin2 btn-primary mt-3" data-onsuccess="onSignIn">Direct login with Google</div> -->

                            <button type="google_signin" class="btn btn-primary mt-3">
                               {{ __('Direct logi n With Telegram') }}
                            </button>

                            <button type="google_signin" class="btn btn-primary mt-3">
                               {{ __('Direct login With Facebook') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
