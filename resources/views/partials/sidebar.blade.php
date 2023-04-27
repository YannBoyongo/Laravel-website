<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="{{ route('welcome') }}" class="brand-link">
        <img src="{{ asset('images/logo_white_fr.png') }}" alt="Site logo" class="img-fluid">
    </a>

    <div class="sidebar">

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ $current == 'dashboard' ? 'active' : null }}">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>
                            {{ __('Tableau de bord') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('banners.index') }}"
                        class="nav-link {{ $current == 'sliders' ? 'active' : null }}">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            {{ __('Bannières') }}
                        </p>
                    </a>
                </li>


                <li class="nav-item {{ ($current == 'reports_create' or $current == 'reports' or $current == 'categories' or $current == 'reports_index' or $current == 'reports_draft') ? 'menu-open' : null }}"
                    aria-expanded="{{ ($current == 'reports' or $current == 'categories' or $current == 'reports_index' or $current == 'active') ? 'true' : 'false' }}">
                    <a href="#"
                        class="nav-link {{ ($current == 'reports_create' or $current == 'reports' or $current == 'categories' or $current == 'reports_index' or $current == 'reports_draft') ? 'active' : null }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            {{ __('Items') }}
                            <i class="fas fa-angle-right right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-3">
                            <a href="" class="nav-link {{ $current == 'categories' ? 'active' : null }}">
                                <i class="nav-icon fas fa-layer-group"></i>
                                <p>{{ __('Catégories') }}</p>
                            </a>
                        </li>
                        <li class="nav-item ml-3">
                            <a href="" class="nav-link {{ $current == 'reports_create' ? 'active' : null }}">
                                <i class="nav-icon fas fa-folder-plus"></i>
                                <p>{{ __('Items') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="" class="nav-link {{ $current == 'pillars' ? 'active' : null }}">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            {{ __('Partenaires') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link {{ $current == 'pillars' ? 'active' : null }}">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            {{ __('Parametres') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link {{ $current == 'pillars' ? 'active' : null }}">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            {{ __('Utilisateurs') }}
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
