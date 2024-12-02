<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <img src="https://siakad.polinema.ac.id/assets/global/img/logo-polinema.png" alt="Polinema Logo" class="brand-image bg-white img-circle">
        <h5><span class="brand-text font-weight-light">pengarsipan surat</span></h5>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu">

                @auth
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon icon ion-md-pulse"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    @can('view-any', App\Models\User::class)
                    <a href="#" class="nav-link">
                        <i class="nav-icon icon ion-md-menu"></i>
                        <p>
                            Pengarsipan
                            <i class="nav-icon right icon ion-md-arrow-round-back"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                            @can('view-any', App\Models\User::class)
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-people"></i>
                                    <p>User Management</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Kategorisurat::class)
                            <li class="nav-item">
                                <a href="{{ route('kategorisurats.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-search"></i>
                                    <p>Kategori Surat</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Arsip::class)
                            <li class="nav-item">
                                <a href="{{ route('arsips.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-cog"></i>
                                    <p>Arsip Surat</p>
                                </a>
                            </li>
                            @endcan
                    </ul>
                    @endcan
                </li>
                @endauth


                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon icon ion-md-exit"></i>
                        <p>{{ __('Logout') }}</p>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                @endauth
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
