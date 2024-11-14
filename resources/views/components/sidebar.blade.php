<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#"><img src="{{ asset('template/img/logo.png') }}" alt="logo" width="40">
                Layanan Pengaduan
            </a>

        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">LP</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
                <li class="nav-item dropdown">
                    <a href="{{ route('home') }}" class="nav-link"><i class="fa-solid fa-gauge"></i><span>Dashboard</span></a>
                </li>

                @role('admin')
                <li class="nav-item dropdown">
                    <a href="{{ route('user.index') }}" class="nav-link"><i class="fa-solid fa-users"></i><span>Users</span></a>
                </li>
                @endrole

                @role('anggota|admin')
                <li class="nav-item dropdown">
                    <a href="{{ route('pengaduan.index') }}" class="nav-link "><i class="fa-solid fa-file-export"></i><span>Pengaduan</span></a>
                </li>
                @endrole

                @role('user')
                <li class="nav-item dropdown">
                    <a href="{{ route('pengaduanuser.index') }}" class="nav-link"><i class="fas fa-user-edit"></i><span>Pengaduan Saya</span></a>
                </li>
                @endrole

                @role('admin|anggota')
                <li class="nav-item dropdown">
                    <a href="{{ route('categories.index') }}" class="nav-link"><i class="fa-solid fa-folder-open"></i><span>Categories</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a href="{{ route('article.index') }}" class="nav-link"><i class="fa-solid fa-book"></i><span>Artikel</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a href="{{ route('anggota.index') }}" class="nav-link"><i class="fa-solid fa-people-group"></i><span>Keanggotaan</span></a>
                </li>
                @endrole
        </ul>



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
