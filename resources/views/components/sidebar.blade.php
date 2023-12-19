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
            <li class="nav-item dropdown {{ $type_menu === 'user' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-user"></i>
                    <span>Users</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('user') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('user.index') }}">User</a>
                    </li>

                </ul>
            </li>

        </ul>
    </aside>
</div>
