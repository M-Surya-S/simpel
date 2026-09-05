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
        <div class="card bg-base-100 shadow-md rounded-2xl">
            <div class="card-body p-0">
                <div class="px-5 pt-5 pb-3">
                    <h3 class="text-base font-bold text-base-content flex items-center gap-2">
                        <i class="fa fa-ranking-star text-warning text-sm"></i>
                        Hasil Perankingan
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
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($alternatif as $a)
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
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-base-content/50 py-8">
                                        <i class="fa fa-inbox text-3xl mb-2 block"></i>
                                        Belum ada data ranking.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection




