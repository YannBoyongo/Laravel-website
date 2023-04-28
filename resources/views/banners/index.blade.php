@extends('layouts.back', ['current' => 'banners'])

@section('title', 'banners')
@section('styles')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/jquery-confirm/dist/jquery-confirm.min.css') }}">
@endsection
@section('breadcrumb')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Bannières') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">{{ __('Accueil') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('bannières') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('content')
    <div class="row">
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">{{ __('Toutes les bannières') }}</h2>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bannerStoreModal">
                            <i class="fas fa-plus mr-2"></i>
                            {{ __('Ajouter bannière') }}
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover  table-sm text-nowrap">
                        <thead class="tbl-head bg-dark-light">
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th>{{ __('Image') }}</th>
                                <th>{{ __('Statut') }}</th>
                                <th style="width: 15%;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($banners->isNotEmpty())
                                @forelse($banners as $banner)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>
                                            <a href="#">
                                                @if ($banner->image)
                                                    <img class="mr-2" width="40" height="40"
                                                        src="{{ asset('storage/banners/' . $banner->image . '') }}"
                                                        style="object-fit: cover; object-position: center"
                                                        alt="{{ $banner->url }}">
                                                @else
                                                    <img class="mr-2" width="40" height="40"
                                                        src="{{ asset('images/no-image.jpg') }}"
                                                        style="object-fit: cover; object-position: center" alt="unknown">
                                                @endif
                                            </a>
                                        </td>
                                        <td>
                                            @if ($banner->status == \App\Models\banner::ACTIVE)
                                                <span class="badge badge-primary }}">{{ __('Activée') }}</span>
                                            @endif
                                            @if ($banner->status == \App\Models\banner::INACTIVE)
                                                <span class="badge badge-secondary }}">{{ __('Désactivée') }}</span>
                                            @endif
                                        </td>
                                        <td class="d-flex justify-content-end">
                                            <a href="{{ route('banners.edit', $banner->id) }}">
                                                <i class="fa mr-2 fa-edit text-warning" title="{{ __('Modifier') }}"></i>
                                            </a>
                                            @if ($banner->status == \App\Models\banner::ACTIVE)
                                                <a href="{{ route('banners.deactivate', $banner->id) }}" class="delBtn"
                                                    data-title="{{ __('Êtes-vous sûr de vouloir désactiver cette bannière?') }}">
                                                    <i class="fa fa-thumbs-up mr-2 text-success"
                                                        title="{{ __('Désactiver') }}"></i>
                                                </a>
                                            @endif
                                            @if ($banner->status == \App\Models\banner::INACTIVE)
                                                <a href="{{ route('banners.activate', $banner->id) }}" class="activateBtn"
                                                    data-title="{{ __('Êtes-vous sûr de vouloir activer cette bannière?') }}">
                                                    <i class="fa fa-thumbs-down ml-2 mr-2 text-danger"
                                                        title="{{ __('Activer') }}"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="text-align: center;">
                                            {{ __('Aucune bannière enregistrée!') }}</td>
                                    </tr>
                                @endforelse
                            @else
                                <tr>
                                    <td colspan="5" style="text-align: center;">{{ __('Aucun bannière enregistrée!') }}
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                @if ($banners->hasPages())
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            <li class="page-item">
                                <a class="btn btn-default btn-sm {{ $banners->onFirstPage() ? 'disabled' : null }}"
                                    href="{{ $banners->previousPageUrl() }}">&laquo;</a>
                            </li>
                            <li class="page-item">
                                <a href="{{ $banners->nextPageUrl() }}"
                                    class="btn btn-default btn-sm {{ !$banners->hasMorePages() ? 'disabled' : null }}">&raquo;</a>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{--  ADD banner MODAL --}}
    <form enctype="multipart/form-data" action="{{ route('banners.store') }}" method="POST">
        @csrf
        <div class="modal fade" id="bannerStoreModal" tabindex="-1" aria-labelledby="bannerStoreModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bannerStoreModalLabel">{{ __('AJOUTER UNE BANNIÈRE') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">{{ __('Titre') }}</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" rows="5" name="title"
                                        placeholder="{{ __('Entrer Texte') }}">
                                    @error('title')
                                        <span class="small text-danger" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="image">{{ __('Image') }}<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input value="{{ old('image') }}" type="file" class="custom-file-input"
                                                name="image" id="image" accept="image/*">
                                            <label class="custom-file-label"
                                                for="image">{{ __('Choisir image') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-body text-center p-0">
                                        <img class="img-thumbnail w-100" id="banner_img"
                                            src="{{ asset('images/no-image.jpg') }}" alt="Image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('Annuler') }}</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-2"></i>
                                {{ __('Enregistrer') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
@section('scripts')
    <script src="{{ asset('adminlte/plugins/jquery-confirm/dist/jquery-confirm.min.js') }}"></script>
    <script type="text/javascript">
        $('a.delBtn').confirm({
            //icon: 'fas fa-trash',
            content: "",
            type: 'red',
            typeAnimated: true,
            buttons: {
                {{ __('Désactiver') }}: function() {
                    location.href = this.$target.attr('href');

                },
                {{ __('Annuler') }}: function() {},
            }
        });
    </script>
    <script type="text/javascript">
        $('a.activateBtn').confirm({
            //icon: 'fas fa-trash',
            content: "",
            type: 'green',
            typeAnimated: true,
            buttons: {
                {{ __('Activer') }}: function() {
                    location.href = this.$target.attr('href');

                },
                {{ __('Annuler') }}: function() {},
            }
        });
    </script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#banner_img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image").change(function() {
            readURL(this);
        });
    </script>
@endsection
