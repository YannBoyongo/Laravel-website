@extends('layouts.back', ['current' => 'partners'])

@section('title', 'Partners')
@section('styles')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/jquery-confirm/dist/jquery-confirm.min.css') }}">
@endsection

@section('breadcrumb')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Partenaires') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">{{ __('Accueil') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('partenaires') }}</li>
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
                    <h2 class="card-title">{{ __('Tous les partenaires') }}</h2>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#partnerStoreModal">
                            <i class="fas fa-plus mr-2"></i>
                            {{ __('Ajouter partenaire') }}
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover  table-sm text-nowrap">
                        <thead class="tbl-head bg-dark-light">
                            <tr>
                                <th style="width: 5%">#</th>
                                <th>{{ __('Lien') }}</th>
                                <th>{{ __('Statut') }}</th>
                                <th style="width: 15%;"></th>

                            </tr>
                        </thead>
                        <tbody>
                            @if ($partners->isNotEmpty())
                                @forelse($partners as $partner)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>
                                            <a href="" target="blank">
                                                @if ($partner->logo)
                                                    <img class="mr-2" width="40" height="40"
                                                        src="{{ asset('storage/partners/' . $partner->logo . '') }}"
                                                        style="object-fit: cover; object-position: center"
                                                        alt="{{ $partner->url }}">
                                                @else
                                                    <img class="mr-2" width="40" height="40"
                                                        src="{{ asset('images/no-image.jpg') }}"
                                                        style="object-fit: cover; object-position: center" alt="unknown">
                                                @endif
                                                <span>{{ $partner->url }}</span>
                                            </a>
                                        </td>
                                        <td>
                                            @if ($partner->status == \App\Models\Partner::ACTIVE)
                                                <span class="badge badge-primary">{{ __('Actif') }}</span>
                                            @endif
                                            @if ($partner->status == \App\Models\Partner::INACTIVE)
                                                <span class="badge badge-secondary">{{ __('Désactivé') }}</span>
                                            @endif
                                        </td>
                                        <td class="d-flex justify-content-end">
                                            @if ($partner->status == \App\Models\Partner::ACTIVE)
                                                <a href="{{ route('partners.deactivate', $partner->id) }}" class="delBtn"
                                                    data-title="{{ __('Êtes-vous sûr de vouloir désactiver ce partenaire?') }}">
                                                    <i class="fa fa-thumbs-up mr-2 text-success"
                                                        title="{{ __('Désactiver') }}"></i>
                                                </a>
                                            @endif
                                            @if ($partner->status == \App\Models\Partner::INACTIVE)
                                                <a href="{{ route('partners.activate', $partner->id) }}"
                                                    class="activateBtn"
                                                    data-title="{{ __('Êtes-vous sûr de vouloir activer ce partenaire?') }}">
                                                    <i class="fa fa-thumbs-down ml-2 mr-2 text-danger"
                                                        title="{{ __('Activer') }}"></i>
                                                </a>
                                            @endif
                                            <a href="{{ route('partners.delete', $partner->id) }}" class="delBtn"
                                                data-title="{{ __('Êtes-vous sûr de vouloir supprimer?') }}">
                                                <i class="fa fa-trash-alt ml-2 mr-2 text-danger"
                                                    title="{{ __('Supprimer') }}"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" style="text-align: center;">
                                            {{ __('Aucun partenaire enregistré!') }}</td>
                                    </tr>
                                @endforelse
                            @else
                                <tr>
                                    <td colspan="4" style="text-align: center;">{{ __('Aucun partenaire enregistré!') }}
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                @if ($partners->hasPages())
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            <li class="page-item">
                                <a class="btn btn-default btn-sm {{ $partners->onFirstPage() ? 'disabled' : null }}"
                                    href="{{ $partners->previousPageUrl() }}">&laquo;</a>
                            </li>
                            <li class="page-item">
                                <a href="{{ $partners->nextPageUrl() }}"
                                    class="btn btn-default btn-sm {{ !$partners->hasMorePages() ? 'disabled' : null }}">&raquo;</a>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{--  ADD PARTNER MODAL --}}
    <form enctype="multipart/form-data" action="{{ route('partners.store') }}" method="POST">
        @csrf
        <div class="modal fade" id="partnerStoreModal" tabindex="-1" aria-labelledby="partnerStoreModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="partnerStoreModalLabel">{{ __('AJOUTER UN PARTENAIRE') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="url">{{ __('Lien') }}</label>
                                    <input type="text" name="url" class="form-control" id="url"
                                        value="{{ old('url') }}" placeholder="https://partner.com">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="logo">{{ __('Logo') }}<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input value="{{ old('logo') }}" type="file" class="custom-file-input"
                                                name="logo" id="logo" accept="image/*">
                                            <label class="custom-file-label"
                                                for="logo">{{ __('Choisir image') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-body text-center p-0">
                                        <img class="img-thumbnail w-100" id="partner_img"
                                            src="{{ asset('images/no-image.jpg') }}" alt="Logo">
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
    <script type="text/javascript">
        $('a.delBtn').confirm({
            //icon: 'fas fa-trash',
            content: "",
            type: 'red',
            typeAnimated: true,
            buttons: {
                {{ __('Supprimer') }}: function() {
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
                    $('#partner_img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#logo").change(function() {
            readURL(this);
        });
    </script>
@endsection
