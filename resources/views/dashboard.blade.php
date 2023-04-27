@extends('layouts.back')
@section('breadcrumb')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Tableau de bord') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">{{ __('Accueil') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Tableau de bord') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box text-white" style="background:#4D525A">
                <div class="inner">
                    <h3>12</h3>
                    <p>{{ __('Documents Récupérés') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-pen"></i>
                </div>
                <a href="#" class="small-box-footer">{{ __('voir plus') }} <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>22</h3>
                    <p>{{ __('Documents Publiés') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-folder-open"></i>
                </div>
                <a href="#" class="small-box-footer">{{ __('voir plus') }}<i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box text-white" style="background:#4D525A">
                <div class="inner">
                    <h3>65</h3>
                    <p>{{ __('Documents enregistrer') }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">{{ __('voir plus') }} <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>34</h3>
                    <p>{{ __('Utilisateurs Actifs') }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">{{ __('voir plus') }} <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

    </div>

    <div class="card bg-gradient-info">
        <div class="card-header border-0">
            <h3 class="card-title">
                <i class="fas fa-th mr-1"></i>
                Graphique de documents recuperé
            </h3>
            <div class="card-tools">
                <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <canvas class="chart" id="line-chart"
                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>

        <div class="card-footer bg-transparent">
            <div class="row">
                <div class="col-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="20" data-width="60"
                        data-height="60" data-fgColor="#39CCCC">
                    <div class="text-white">Mail-Orders</div>
                </div>

                <div class="col-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="50" data-width="60"
                        data-height="60" data-fgColor="#39CCCC">
                    <div class="text-white">Online</div>
                </div>

                <div class="col-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="30" data-width="60"
                        data-height="60" data-fgColor="#39CCCC">
                    <div class="text-white">In-Store</div>
                </div>

            </div>

        </div>

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
@endsection
