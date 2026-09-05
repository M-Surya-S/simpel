<aside class="bg-base-100 w-60 min-h-screen flex flex-col">
    <!-- Brand -->
    <div class="p-6">
        <a href="{{ url('/') }}" class="flex items-center gap-3 group">
            <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center shadow-lg shadow-primary/30 group-hover:shadow-primary/50 transition-shadow duration-300">
                <i class="fa fa-graduation-cap text-primary-content text-lg"></i>
            </div>
            <div>
                <span class="text-lg font-bold tracking-tight text-base-content">SIMPEL</span>
                <p class="text-[10px] text-base-content/50 -mt-0.5 font-medium">Sistem Penentuan Kelulusan</p>
            </div>
        </a>
    </div>

    <!-- Navigation Menu -->
    <nav class="sidebar-menu flex-1 px-3 py-4">
        <ul class="menu menu-sm gap-1">
            <!-- Dashboard -->
            <li class="menu-item">
                <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">
                    <i class="fa fa-tv w-5 text-center text-xs"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Section: Konfigurasi -->
            <li class="menu-title mt-4">
                <span class="text-xs font-bold uppercase tracking-wider text-base-content/40">Konfigurasi</span>
            </li>

            <li class="menu-item">
                <a href="{{ route('kriteria-bobot') }}" class="{{ request()->is('kriteria-bobot*') ? 'active' : '' }}">
                    <i class="fa fa-scale-balanced w-5 text-center text-xs"></i>
                    <span>Kriteria & Bobot</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('alternatif') }}" class="{{ request()->is('alternatif*') ? 'active' : '' }}">
                    <i class="fa fa-clipboard-user w-5 text-center text-xs"></i>
                    <span>Alternatif</span>
                </a>
            </li>

            <!-- Section: Hasil -->
            <li class="menu-title mt-4">
                <span class="text-xs font-bold uppercase tracking-wider text-base-content/40">Hasil</span>
            </li>

            <li class="menu-item">
                <a href="{{ route('matrix') }}" class="{{ request()->is('matrix*') ? 'active' : '' }}">
                    <i class="fa fa-chart-simple w-5 text-center text-xs"></i>
                    <span>Table Matrix</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('ranking') }}" class="{{ request()->is('ranking*') ? 'active' : '' }}">
                    <i class="fa fa-arrow-down-1-9 w-5 text-center text-xs"></i>
                    <span>Table Ranking</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Footer removed for cleaner look -->
</aside>




