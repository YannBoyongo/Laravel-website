@extends('layouts.auth.app')

@section('content')
    <div class="card">
        <div class="card-body login-card-body">
            <form action="{{ route('password.store') }}" method="POST">
                <!-- Password Reset Token -->
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div class="mb-3">
                    <input type="email" name="email" value="{{ old('email', $request->email) }}" class="form-control"
                        placeholder="Email" autofocus>
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="{{ __('Mot de passe') }}"
                        required>
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <input type="password" name="password_confirmation" class="form-control"
                        placeholder="{{ __('Confirmer mot de passe') }}" required>
                    @error('password_confirmation')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-12 mb-3">
                        <button type="submit"
                            class="btn btn-primary btn-block">{{ __('réinitialiser le mot de passe') }}</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
