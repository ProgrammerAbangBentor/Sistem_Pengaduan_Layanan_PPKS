<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Layanan Pengaduan</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">LP</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('home') }}">General Dashboard</a>
                    </li>

                </ul>
            </li>


            <li class="nav-item dropdown">
            {{-- @can('view users') <!-- Hanya tampilkan menu ini jika pengguna memiliki izin 'view users' --> --}}
            {{-- @if(auth()->user()->role === 'admin') --}}
            @role('admin')
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-user"></i><span>Users</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('user.index') }}">All Users</a>
                    </li>

                </ul>
                {{-- @endif --}}
                {{-- @endcan --}}

                @endrole
            </li>

            @role('anggota|admin')
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-alt"></i><span>Pengaduan</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('pengaduan.index') }}">Pengaduan</a>
                    </li>
                </ul>
            </li>
            @endrole

            @role('user')
            <li class="nav-item">
                <a href="{{ route('pengaduanuser.index') }}" class="nav-link"><i class="fas fa-user-edit"></i><span>Pengaduan Saya</span></a>
            </li>
            @endrole
            @role('admin|anggota')
            <li class="nav-item">
                <a href="{{ route('categories.index') }}" class="nav-link"><i class="fas fa-th-large"></i><span>Categories</span></a>
            </li>
            @endrole
            {{-- <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Categories</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('categories.index') }}">All Category</a>
                    </li>

                </ul>
            </li> --}}
        </ul>
    </aside>
</div>
