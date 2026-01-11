<div class="d-flex flex-column p-3 bg-dark text-white" style="height: 100vh; width: 250px;">
    <h4>Menu</h4>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('anggota.index') }}">Anggota</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('peminjaman.index') }}">Peminjaman</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('staff.index') }}">Staff</a>
        </li>
        <li class="nav-item">
    <a class="nav-link text-white" href="{{ route('laporan.index') }}">Laporan</a>
</li>
        
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">Logout</button>
            </form>
        </li>
    </ul>
</div>
