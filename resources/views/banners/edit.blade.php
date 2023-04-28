@extends('layouts.back', ['current' => 'banners'])

@section('title', 'Edit banner')
@section('styles')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/jquery-confirm/dist/jquery-confirm.min.css') }}">
@endsection
@section('breadcrumb')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Modifier une bannière') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Tableau de bord') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('banners.index') }}">{{ __('bannières') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Modifier une bannière') }}</li>
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
                    <h3 class="card-title">{{ __('Modifier une bannière') }}</h3>
                </div>

                <form action="{{ route('banners.update', $banner->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <input type="hidden" name="bannerId" value={{ $banner->id }}>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">{{ __('Titre') }} <small>[Fr]</small></label>
                                    <input type="text" class="form-control"
                                        placeholder="{{ __('Entrer le nom en Français') }}" name="title" id="title"
                                        value="{{ old('title', $banner->title) }}">
                                    @error('title')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex">
                        <div class="flex-grow-1">
                            <button type="button" class="btn bg-gradient-danger" data-toggle="modal"
                                data-target="#deleteModal">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                        </div>
                        <div class="flex-grow-1 text-right">
                            <button type="submit" class="btn btn-primary">
                                {{ _('Enregister') }}
                                <i class="fa fa-save ml-2"></i>
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header card-outline card-primary">
                    <h3 class="card-title">
                        {{ __('Image') }}<span class="text-danger">*</span>
                    </h3>
                </div>
                @if ($banner->image)
                    <div class="card-body text-center p-0">
                        <img class="img-thumbnail w-100" src="{{ asset('storage/banners/' . $banner->image . '') }}"
                            alt="{{ __('Bannière') }}">
                    </div>
                    <form method="POST" action="{{ route('banners.delete.image', $banner->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                        </div>
                    </form>
                @else
                    <form enctype="multipart/form-data" role="form" method="POST"
                        action="{{ route('banners.add.image', $banner->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image"
                                            accept="image/*">
                                        <label class="custom-file-label" for="image">{{ __('Choisir image') }}</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <button name="submit" type="submit" class="btn btn-primary">
                                {{ __('Enregistrer') }}
                                <i class="fas fa-save ml-2"></i>
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

    {{-- DELETE banner MODAL --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('banners.destroy', $banner->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="slug" id="modal_delete_slug">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">{{ __('Supprimer une bannière') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ __('Êtes-vous sûr de vouloir supprimer cette bannière?') }} "<span class="text-bold"
                            id="modal_delete_title"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            {{ __('Annuler') }}
                            <i class="fa fa-times ml-2"></i>
                        </button>
                        <button type="submit" class="btn btn-danger">
                            {{ __('Supprimer') }}
                            <i class="fa fa-trash-alt ml-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    @include('partials.back.bs_custom_file')
    @include('partials.back.jquery_confirm_btn')

@endsection
