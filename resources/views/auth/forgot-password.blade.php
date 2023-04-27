@extends('layouts.auth.app')

@section('content')
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">
                {{ __('Vous avez oublié votre mot de passe ? Indiquez-nous votre adresse électronique et nous vous enverrons un lien de réinitialisation du mot de passe') }}
            </p>

            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" autofocus>
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-12 mb-3">
                        <button type="submit" class="btn btn-primary btn-block">{{ __('Envoyer lien') }}</button>
                    </div>
                </div>

            </form>

            <p class="mb-1">
                <a href="{{ route('login') }}">{{ __('Vous êtes déjà inscrit ?') }}</a>
            </p>

        </div>
    </div>
@endsection
