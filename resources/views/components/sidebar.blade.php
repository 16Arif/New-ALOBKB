<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand mt-lg-4">
            <a href="">Aplikasi Logbook Operasional</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="">ALO</a>
        </div>
        <ul class="sidebar-menu mt-4">
            <li class="mt-5 {{ Request::is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('dashboard') }}"><i class="fas fa-house"></i> <span>Dashboard</span></a>
            </li>
            <li class="menu-header">Users</li>
            <li class="nav-item dropdown {{ $type_menu === 'error' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-exclamation"></i>
                    <span>Errors</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('error-403') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('error-403') }}">403</a>
                    </li>
                    <li class="{{ Request::is('error-404') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('error-404') }}">404</a>
                    </li>
                    <li class="{{ Request::is('error-500') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('error-500') }}">500</a>
                    </li>
                    <li class="{{ Request::is('error-503') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('error-503') }}">503</a>
                    </li>
                </ul>
            </li>

        </ul>
    </aside>
</div>
