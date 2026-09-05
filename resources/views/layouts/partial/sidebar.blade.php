<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ url('/') }}">
            <span class="ms-1 font-weight-bold">SIMPEL</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-tv text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Dashboard</span>
            </a>
        </li>
        <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Konfigurasi</h6>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('kriteria-bobot*') ? 'active' : '' }}" href="{{ route('kriteria-bobot') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-scale-balanced text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Kriteria & Bobot</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('alternatif*') ? 'active' : '' }}" href="{{ route('alternatif') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-clipboard-user text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Alternatif</span>
            </a>
        </li>
        <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Hasil</h6>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('matrix*') ? 'active' : '' }}" href="{{ route('matrix') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-chart-simple text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Table Matrix</span>
            </a>
            <a class="nav-link {{ request()->is('ranking*') ? 'active' : '' }}" href="{{ route('ranking') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-arrow-down-1-9 text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Table Ranking</span>
            </a>
        </li>
    </ul>
</aside>
