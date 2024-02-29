<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand mt-lg-4">
            <a href="">Aplikasi Logbook Operasional</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="">ALO</a>
        </div>
        <ul class="sidebar-menu mt-4">
            <li class="mt-5 {{ Request::is('home') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('home') }}"><i class="fas fa-house"></i> <span>Dashboard</span></a>
            </li>
            <li class="menu-header">Users</li>
            <li class="{{ Request::is('user') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user.index') }}"><i class="fas fa-user"></i><span>Users</span></a>
            </li>
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
        </ul>
    </aside>
</div>
