@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div>{{ __('Rejestracja') }}</div>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <span class="form-check">
                                        <input class="form-check-input" type="radio" name="role" id="role1" value="1"
                                            checked>
                                        <label class="form-check-label" for="role1">
                                            Uczeń
                                        </label>
                                    </span>
                                    <span class="form-check">
                                        <input class="form-check-input" type="radio" name="role" id="role2" value="2">
                                        <label class="form-check-label" for="role2">
                                            Nauczyciel
                                        </label>
                                    </span>

                                </div>
                            </div>
                            <div id="app">
                                <school-selector />
                            </div>

                            <div class="form-group row">
                                <label for="fname" class="col-md-4 col-form-label text-md-right">{{ __('Imię') }}</label>

                                <div class="col-md-6">
                                    <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror"
                                        name="fname" value="{{ old('fname') }}" required autocomplete="fname" autofocus>

                                    @error('fname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lname"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nazwisko') }}</label>

                                <div class="col-md-6">
                                    <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror"
                                        name="lname" value="{{ old('lname') }}" required autocomplete="lname" autofocus>

                                    @error('l name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Adres e-mail') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Hasło') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Potwierdź hasło') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" style="width: 20.6rem; margin-bottom:5px;">
                                        {{ __('Zarejestruj się') }}
                                    </button> 
                                    <a href="http://google.com/login" class="btn-google" style="text-decoration: none">
                                        <div class="google-icon-box">
                                          <img
                                            class="google-icon"
                                            src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg"
                                          />
                                        </div>
                                        <div class="google-text">Zaloguj się z Google</div>
                                      </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
