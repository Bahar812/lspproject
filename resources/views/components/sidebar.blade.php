<style>
    .sidebar-shell {
        background: linear-gradient(180deg, #0f172a 0%, #1f2937 100%);
        width: 260px;
        min-height: 100vh;
    }
    .sidebar-brand {
        letter-spacing: 0.5px;
    }
    .sidebar-link {
        color: rgba(255, 255, 255, 0.8);
        border-radius: 10px;
        padding: 10px 14px;
        margin-bottom: 6px;
    }
    .sidebar-link:hover,
    .sidebar-link.active {
        color: #ffffff;
        background: rgba(255, 255, 255, 0.12);
    }
    .sidebar-footer {
        margin-top: auto;
    }
</style>

<div class="d-flex flex-column p-3 text-white sidebar-shell">
    <div class="mb-4">
        <h4 class="sidebar-brand mb-1">Perpustakaan</h4>
        <small class="text-white-50">Panel Admin</small>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        @if (auth()->check() && auth()->user()->role === 'admin')
            <li class="nav-item">
                <a class="nav-link sidebar-link {{ request()->routeIs('anggota.*') ? 'active' : '' }}" href="{{ route('anggota.index') }}">Anggota</a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar-link {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}" href="{{ route('peminjaman.index') }}">Peminjaman</a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar-link {{ request()->routeIs('staff.*') ? 'active' : '' }}" href="{{ route('staff.index') }}">Staff</a>
            </li>
        @endif
    </ul>

    <div class="sidebar-footer pt-3">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-light w-100">Logout</button>
        </form>
    </div>
</div>
