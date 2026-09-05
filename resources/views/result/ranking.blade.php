@extends('layouts.app')

@section('title', 'Table Ranking')

@section('main')
    <!-- Page Header -->
    <div class="px-6 py-6 pb-2">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-sm breadcrumbs text-primary-content/70 mb-1">
                    <ul>
                        <li><a href="{{ route('home') }}" class="breadcrumb-link"><i class="fa fa-home text-xs"></i></a></li>
                        <li>Table Ranking</li>
                    </ul>
                </div>
                <h1 class="text-2xl font-bold text-primary-content">Table Ranking</h1>
            </div>
            <div class="flex items-center gap-2">
                <label for="sidebar-drawer" class="btn btn-ghost btn-sm text-primary-content lg:hidden">
                    <i class="fa fa-bars"></i>
                </label>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="p-6 flex-1">
        <!-- Table Lulus -->
        <div class="card bg-base-100 shadow-md rounded-2xl mb-6">
            <div class="card-body p-0">
                <div class="px-5 pt-5 pb-3">
                    <h3 class="text-base font-bold text-success flex items-center gap-2">
                        <i class="fa fa-check-circle text-success text-sm"></i>
                        Ranking Kandidat Lulus
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="table table-zebra">
                        <thead>
                            <tr>
                                <th class="text-center text-xs font-bold uppercase text-base-content/50">Ranking</th>
                                <th class="text-center text-xs font-bold uppercase text-base-content/50">Nama Peserta</th>
                                <th class="text-center text-xs font-bold uppercase text-base-content/50">Vektor V</th>
                                <th class="text-center text-xs font-bold uppercase text-base-content/50">Status</th>
                                <th class="text-center text-xs font-bold uppercase text-base-content/50">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($alternatif_lulus as $a)
                                <tr class="hover">
                                    <td class="text-center">
                                        @if ($loop->iteration <= 3)
                                            <div class="flex items-center justify-center">
                                                <span class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold text-white
                                                    {{ $loop->iteration == 1 ? 'bg-warning' : ($loop->iteration == 2 ? 'bg-base-content/40' : 'bg-amber-700') }}">
                                                    {{ $loop->iteration }}
                                                </span>
                                            </div>
                                        @else
                                            <span class="font-semibold text-sm text-base-content/60">{{ $loop->iteration }}.</span>
                                        @endif
                                    </td>
                                    <td class="text-center font-semibold text-sm">{{ $a->name }}</td>
                                    <td class="text-center font-mono text-sm font-semibold">
                                        {{ number_format($vektor_v[$a->id] ?? 0, 3) }}
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-success badge-sm gap-1 font-semibold">
                                            <i class="fa fa-check text-[10px]"></i>
                                            {{ $a->status }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <button onclick="modal_detail_{{ $a->id }}.showModal()" class="btn btn-sm btn-ghost text-info">
                                            <i class="fa fa-circle-info"></i> Detail
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-base-content/50 py-8">
                                        <i class="fa fa-inbox text-3xl mb-2 block"></i>
                                        Tidak ada kandidat yang Lulus.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Table Tidak Lulus -->
        <div class="card bg-base-100 shadow-md rounded-2xl">
            <div class="card-body p-0">
                <div class="px-5 pt-5 pb-3">
                    <h3 class="text-base font-bold text-error flex items-center gap-2">
                        <i class="fa fa-times-circle text-error text-sm"></i>
                        Kandidat Tidak Lulus
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="table table-zebra">
                        <thead>
                            <tr>
                                <th class="text-center text-xs font-bold uppercase text-base-content/50">Urutan</th>
                                <th class="text-center text-xs font-bold uppercase text-base-content/50">Nama Peserta</th>
                                <th class="text-center text-xs font-bold uppercase text-base-content/50">Vektor V</th>
                                <th class="text-center text-xs font-bold uppercase text-base-content/50">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($alternatif_tidak_lulus as $a)
                                <tr class="hover">
                                    <td class="text-center">
                                        <span class="font-semibold text-sm text-base-content/60">{{ $loop->iteration }}.</span>
                                    </td>
                                    <td class="text-center font-semibold text-sm">{{ $a->name }}</td>
                                    <td class="text-center font-mono text-sm font-semibold">
                                        {{ number_format($vektor_v[$a->id] ?? 0, 3) }}
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-error badge-sm gap-1 font-semibold">
                                            <i class="fa fa-xmark text-[10px]"></i>
                                            {{ $a->status }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <button onclick="modal_detail_{{ $a->id }}.showModal()" class="btn btn-sm btn-ghost text-info">
                                            <i class="fa fa-circle-info"></i> Detail
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-base-content/50 py-8">
                                        <i class="fa fa-inbox text-3xl mb-2 block"></i>
                                        Tidak ada kandidat yang Tidak Lulus.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals untuk Detail -->
    @foreach ($alternatif_lulus->merge($alternatif_tidak_lulus) as $a)
    <dialog id="modal_detail_{{ $a->id }}" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg text-primary-content mb-4 border-b pb-2">Detail Nilai - {{ $a->name }}</h3>
            
            <div class="overflow-x-auto">
                <table class="table table-sm table-zebra w-full">
                    <thead>
                        <tr>
                            <th class="text-base-content/70">Kriteria</th>
                            <th class="text-base-content/70">Keterangan</th>
                            <th class="text-base-content/70 text-center">Rate</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($a->skor_alternatif as $skor)
                        <tr>
                            <td class="font-medium">{{ $skor->kriteria->kriteria }}</td>
                            <td>{{ $skor->sub_kriteria->desc ?? '-' }}</td>
                            <td class="text-center">
                                <span class="badge badge-sm font-semibold {{ ($skor->sub_kriteria->rate ?? 0) < 2 ? 'badge-error' : 'badge-ghost' }}">
                                    Rate {{ $skor->sub_kriteria->rate ?? 0 }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex justify-between items-center bg-base-200/50 p-4 rounded-xl border border-base-300">
                <span class="font-bold text-base-content">Skor Akhir WP (Vektor V)</span>
                <span class="font-mono font-bold text-lg text-primary">{{ number_format($vektor_v[$a->id] ?? 0, 4) }}</span>
            </div>

            <div class="modal-action">
                <form method="dialog">
                    <button class="btn btn-sm btn-ghost">Tutup</button>
                </form>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
    @endforeach

@endsection




