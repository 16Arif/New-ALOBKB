<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand mt-lg-4">
            <img src="\img\alobkb3.png" alt="logo_alo" style="max-height: 100px">
            <br>
            <a href="" class="ml-2" style="font-size: 10px">Aplikasi Logbook Operasional</a>
        </div>

        <div class="sidebar-brand sidebar-brand-sm">
            <a href="">ALO</a>
        </div>
        <ul class="sidebar-menu mt-4">
            <li class="mt-5 {{ Request::is('home') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('home') }}"><i class="fas fa-house"></i> <span>Dashboard</span></a>
            </li>
            @can('admin')
                <li class="menu-header">Users</li>
                <li class="{{ Request::is('user') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('user.index') }}"><i class="fas fa-user"></i><span>Users</span></a>
                </li>
            @endcan
            <li class="menu-header">Logbook</li>
            <li class="{{ Request::is('logbookpetir') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('logbookpetir.index') }}"><i
                        class="fas fa-bolt-lightning"></i></i><span>Logbook Petir</span></a>
            </li>
            <li class="{{ Request::is('logbookgempa') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('logbookgempa.index') }}"><i
                        class="fas fa-house-crack"></i></i><span>Logbook
                        Gempa</span></a>
            </li>
            <li class="{{ Request::is('logbookperalatan') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('logbookperalatan.index') }}"><i
                        class="fas fa-screwdriver-wrench"></i><span>Logbook Peralatan</span></a>
            </li>
            <li class="menu-header">Gempabumi</li>
            <li class="{{ Request::is('gempabumi/create') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('gempabumi.create') }}"><i
                        class="fas fa-solid fa-panorama"></i><span>Buat Info Gempa</span></a>
            </li>
            <li class="{{ Request::is('gempabumi') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('gempabumi.index') }}"><i
                        class="fas fa-solid fa-rectangle-list"></i><span>Data Gempa</span></a>
            </li>

            <li class="{{ Request::is('gempabumi/infografiss') ? 'active' : '' }}">
                <a class="nav-link"><i class="fas fa-solid fa-list-ol"></i><span>
                        Peta Kegempaan</span></a>
            </li>
        </ul>

        <ul class="sidebar-menu mt-4">
            <li class="menu-header">Info</li>
            <li>
                <a class="nav-link" href="{{ route('about') }}"><i
                        class="fas fa-info-circle"></i><span>Tentang</span></a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('help') }}"><i
                        class="fas fa-info-circle"></i><span>Bantuan</span></a>
            </li>
        </ul>
    </aside>
</div>
