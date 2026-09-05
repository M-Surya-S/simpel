@extends('layouts.app')

@section('title', 'Alternatif')

@section('main')
    <!-- Page Header -->
    <div class="px-6 py-6 pb-2">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-sm breadcrumbs text-primary-content/70 mb-1">
                    <ul>
                        <li><a href="{{ route('home') }}" class="breadcrumb-link"><i class="fa fa-home text-xs"></i></a></li>
                        <li>Alternatif</li>
                    </ul>
                </div>
                <h1 class="text-2xl font-bold text-primary-content">Alternatif</h1>
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
                <div class="px-5 pt-5 pb-3 flex items-center justify-between">
                    <h3 class="text-base font-bold text-base-content">Data Alternatif</h3>
                    <a href="{{ route('add-alternatif') }}" class="btn btn-primary btn-sm gap-1">
                        <i class="fas fa-plus text-xs"></i>
                        Tambah Alternatif
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="table table-zebra">
                        <thead>
                            <tr>
                                <th class="text-center text-xs font-bold uppercase text-base-content/50">No</th>
                                <th class="text-center text-xs font-bold uppercase text-base-content/50">Nama Peserta</th>
                                @foreach ($kriteria as $k)
                                    <th class="text-center text-xs font-bold uppercase text-base-content/50">{{ $k->kriteria }}</th>
                                @endforeach
                                <th class="text-center text-xs font-bold uppercase text-base-content/50">Status</th>
                                <th class="text-center text-xs font-bold uppercase text-base-content/50">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($alternatif as $a)
                                <tr class="hover">
                                    <td class="text-center font-semibold text-sm">
                                        {{ ($alternatif->currentPage() - 1) * $alternatif->perPage() + $loop->iteration }}.
                                    </td>
                                    <td class="text-center font-semibold text-sm">{{ $a->name }}</td>
                                    @foreach ($kriteria as $k)
                                        @php
                                            $skor = $a->skor_alternatif->firstWhere('id_kriteria', $k->id);
                                        @endphp
                                        <td class="text-center text-sm">{{ $skor ? $skor->sub_kriteria->desc : '-' }}</td>
                                    @endforeach
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
                                    <td class="text-center">
                                        <div class="flex items-center justify-center gap-1 flex-wrap">
                                            <a href="{{ route('edit-alternatif', $a->id) }}"
                                                class="btn btn-xs gap-1 bg-warning/20 text-warning hover:bg-warning hover:text-warning-content border-none">
                                                <i class="fas fa-edit text-[10px]"></i> Edit
                                            </a>
                                            <form id="delete-form-{{ $a->id }}"
                                                action="{{ route('delete-alternatif', $a->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    onclick="confirmDelete('delete-form-{{ $a->id }}')"
                                                    class="btn btn-xs gap-1 bg-error/20 text-error hover:bg-error hover:text-error-content border-none">
                                                    <i class="fas fa-trash-alt text-[10px]"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ $jumlah_kriteria + 4 }}" class="text-center text-base-content/50 py-8">
                                        <i class="fa fa-inbox text-3xl mb-2 block"></i>
                                        Belum ada data alternatif.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($alternatif->hasPages())
                    <div class="flex justify-center py-4">
                        <div class="join">
                            {{-- Previous --}}
                            <a href="{{ $alternatif->previousPageUrl() ?? '#' }}"
                                class="join-item btn btn-sm {{ $alternatif->onFirstPage() ? 'btn-disabled' : '' }}">
                                <i class="fa fa-angle-left"></i>
                            </a>

                            {{-- Page Numbers --}}
                            @foreach ($alternatif->getUrlRange(1, $alternatif->lastPage()) as $page => $url)
                                <a href="{{ $url }}"
                                    class="join-item btn btn-sm {{ $alternatif->currentPage() == $page ? 'btn-primary' : '' }}">
                                    {{ $page }}
                                </a>
                            @endforeach

                            {{-- Next --}}
                            <a href="{{ $alternatif->nextPageUrl() ?? '#' }}"
                                class="join-item btn btn-sm {{ !$alternatif->hasMorePages() ? 'btn-disabled' : '' }}">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection




