@extends('layouts.auth.app')

@section('content')
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">{{ __('Se connecter pour commencer votre session') }}</p>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="{{ __('Email') }}" autofocus>
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="{{ __('Mot de passe') }}">
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-12 mb-2">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">
                                {{ __('Se souvenir de moi') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <button type="submit" class="btn btn-primary btn-block">{{ __('Se connecter') }}</button>
                    </div>
                </div>
            </form>

            <p class="mb-1">
                <a href="{{ route('password.request') }}">{{ __('Mot de passe oublié') }}</a>
            </p>
            <p class="mb-0">
                <a href="{{ route('register') }}" class="text-center">{{ __('Créer un nouveau compte') }}</a>
            </p>
        </div>
    </div>
@endsection
