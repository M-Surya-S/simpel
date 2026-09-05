@extends('layouts.app')

@section('title', 'Dashboard')

@section('main')
    <!-- Page Header -->
    <div class="px-6 py-6 pb-2">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-base-content flex items-center gap-2">
                    <i class="fa fa-tv text-primary"></i>
                    Dashboard
                </h1>
            </div>
            <div class="flex items-center gap-2">
                <label for="sidebar-drawer" class="btn btn-ghost btn-sm text-base-content lg:hidden">
                    <i class="fa fa-bars"></i>
                </label>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="p-6 flex-1">
        <!-- Stat Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-6">
            <!-- Jumlah Alternatif -->
            <div class="card bg-base-100 shadow-md card-hover rounded-2xl">
                <div class="card-body p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-3xl font-bold text-base-content mb-1">{{ $jumlah_alternatif }}</h2>
                            <p class="text-[11px] font-semibold uppercase tracking-wider text-base-content/50">Jumlah Alternatif</p>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-primary/20 flex items-center justify-center">
                            <i class="fa fa-users text-primary text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jumlah Kriteria -->
            <div class="card bg-base-100 shadow-md card-hover rounded-2xl">
                <div class="card-body p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-3xl font-bold text-base-content mb-1">{{ $jumlah_kriteria }}</h2>
                            <p class="text-[11px] font-semibold uppercase tracking-wider text-base-content/50">Jumlah Kriteria</p>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-secondary/20 flex items-center justify-center">
                            <i class="fa fa-chart-bar text-secondary text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jumlah Sub Kriteria -->
            <div class="card bg-base-100 shadow-md card-hover rounded-2xl">
                <div class="card-body p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-3xl font-bold text-base-content mb-1">{{ $jumlah_sub_kriteria }}</h2>
                            <p class="text-[11px] font-semibold uppercase tracking-wider text-base-content/50">Jumlah Sub Kriteria</p>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-accent/20 flex items-center justify-center">
                            <i class="fa fa-chart-line text-accent text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="grid grid-cols-1 lg:grid-cols-7 gap-5">
            <!-- Peringkat Table -->
            <div class="lg:col-span-4">
                <div class="card bg-base-100 shadow-md rounded-2xl">
                    <div class="card-body p-0">
                        <div class="px-6 pt-6 pb-4">
                            <h3 class="text-base font-bold text-base-content flex items-center gap-2">
                                Peringkat
                            </h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="table table-zebra">
                                <thead>
                                    <tr>
                                        <th class="text-xs font-bold uppercase text-base-content/50">#</th>
                                        <th class="text-xs font-bold uppercase text-base-content/50">Nama Peserta</th>
                                        <th class="text-center text-xs font-bold uppercase text-base-content/50">Skor</th>
                                        <th class="text-center text-xs font-bold uppercase text-base-content/50">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sorted_alternatif as $a)
                                        <tr class="hover">
                                            <td class="font-semibold text-base-content/60">{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="font-semibold text-sm">{{ $a->name }}</div>
                                            </td>
                                            <td class="text-center">
                                                <span class="font-mono font-semibold text-sm">{{ number_format($vektor_v[$a->id] ?? 0, 3) }}</span>
                                            </td>
                                            <td class="text-center">
                                                @if ($a->status === 'Lulus')
                                                    <span class="badge badge-success badge-sm gap-1 font-semibold">
                                                        <i class="fa fa-check text-[10px]"></i>
                                                        {{ $a->status }}
                                                    </span>
                                                @else
                                                    <span class="badge badge-error badge-sm gap-1 font-semibold">
                                                        <i class="fa fa-xmark text-[10px]"></i>
                                                        {{ $a->status }}
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kriteria Kelulusan -->
            <div class="lg:col-span-3">
                <div class="card bg-base-100 shadow-md rounded-2xl">
                    <div class="card-body p-6">
                        <h3 class="text-base font-bold text-base-content mb-4">
                            Kriteria Kelulusan Pelatihan
                        </h3>
                        <div class="space-y-3">
                            @foreach ($kriteria_bobot as $kriteria)
                                @php
                                    $sub_kriteria = App\Models\SubKriteria::where('id_kriteria', $kriteria->id)->count();
                                @endphp
                                <div class="flex items-center gap-4 p-3 rounded-xl bg-base-200 hover:bg-base-300 transition-colors duration-200">
                                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0">
                                        <i class="fa fa-list-check text-primary text-sm"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-semibold text-base-content truncate">{{ $kriteria->kriteria }}</h4>
                                        <p class="text-xs text-base-content/50">{{ $sub_kriteria }} Sub Kriteria</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




