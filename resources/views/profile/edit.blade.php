@extends('layouts.back')
@section('title', 'Mon profil')
@section('breadcrumb')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Profil') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">{{ __('Accueil') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Profil') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Information du profil') }}</h3>
                </div>

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">{{ __('Nom') }}</label>
                                    <input type="text" class="form-control" placeholder="{{ __('Entrer le nom') }}"
                                        name="name" id="name" value="{{ old('name', Auth::user()->name) }}">
                                    @error('name')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">{{ __('Source powerbie') }} </label>
                                    <input type="text" class="form-control" placeholder="{{ __('Entrer Email') }}"
                                        name="email" id="email" value="{{ old('email', Auth::user()->email) }}">
                                    @error('email')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer d-flex">
                        <div class="flex-grow-1 text-right">
                            <button type="submit" class="btn btn-primary">
                                {{ _('Modifier') }}
                                <i class="fa fa-save ml-2"></i>
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Modifier mot de passe') }}
                    </h3>
                </div>

                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="current_password">{{ __('Mot de passe actuel') }}</label>
                                    <input type="password" class="form-control"
                                        placeholder="{{ __('Mot de passe actuel') }}" name="current_password"
                                        id="current_password" value="">
                                    @error('current_password')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password">{{ __('Nouveau Mot de passe') }} </label>
                                    <input type="password" class="form-control" placeholder="{{ __('Entrer password') }}"
                                        name="password" id="password" value="">
                                    @error('password')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password_confirmation">{{ __('Confirmer nouveau Mot de passe') }} </label>
                                    <input type="password" class="form-control"
                                        placeholder="{{ __('Entrer password_confirmation') }}" name="password"
                                        id="password_confirmation" value="">
                                    @error('password_confirmation')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer d-flex">
                        <div class="flex-grow-1 text-right">
                            <button type="submit" class="btn btn-primary">
                                {{ _('Modifier') }}
                                <i class="fa fa-save ml-2"></i>
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Supprimer compte') }}</h3>
                </div>
                <form action="{{ route('profile.destroy') }}" method="POST">
                    @csrf
                    @method('delete')
                    <div class="card-body">
                        <p>Une fois votre compte supprimé, toutes ses ressources et données seront définitivement
                            supprimées. Avant
                            de supprimer votre compte, veuillez télécharger les données ou informations que vous souhaitez
                            conserver.</p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password">{{ __('Nouveau Mot de passe') }} </label>
                                    <input type="password" class="form-control"
                                        placeholder="{{ __('Entrer password') }}" name="password" id="password"
                                        value="">
                                    @error('password')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex">
                        <div class="flex-grow-1 text-right">
                            <button type="submit" class="btn btn-primary">
                                {{ _('Supprimer mon compte') }}
                                <i class="fa fa-save ml-2"></i>
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
