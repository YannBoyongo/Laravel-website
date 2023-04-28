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
                        class="nav-link {{ $current == 'banners' ? 'active' : null }}">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            {{ __('Bannières') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('partners.index') }}"
                        class="nav-link {{ $current == 'partners' ? 'active' : null }}">
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
            </ul>
        </nav>
    </div>
</aside>
