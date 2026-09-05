@extends('layouts.app')

@section('title', 'Kriteria dan Bobot')

@section('main')
    <!-- Page Header -->
    <div class="px-6 py-6 pb-2">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-sm breadcrumbs text-primary-content/70 mb-1">
                    <ul>
                        <li><a href="{{ route('home') }}" class="breadcrumb-link"><i class="fa fa-home text-xs"></i></a></li>
                        <li>Kriteria dan Bobot</li>
                    </ul>
                </div>
                <h1 class="text-2xl font-bold text-primary-content">Kriteria dan Bobot</h1>
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
        <!-- Kriteria Table -->
        <div class="card bg-base-100 shadow-md rounded-2xl mb-6">
            <div class="card-body p-0">
                <div class="px-5 pt-5 pb-3 flex items-center justify-between">
                    <h3 class="text-base font-bold text-base-content">Data Kriteria</h3>
                    <a href="{{ route('add-kriteria-bobot') }}" class="btn btn-primary btn-sm gap-1">
                        <i class="fas fa-plus text-xs"></i>
                        Tambah Kriteria
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="table table-zebra">
                        <thead>
                            <tr>
                                <th class="text-center text-xs font-bold uppercase text-base-content/50">No</th>
                                <th class="text-center text-xs font-bold uppercase text-base-content/50">Kriteria</th>
                                <th class="text-center text-xs font-bold uppercase text-base-content/50">Bobot</th>
                                <th class="text-center text-xs font-bold uppercase text-base-content/50">Type</th>
                                <th class="text-center text-xs font-bold uppercase text-base-content/50">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kriteria_bobot as $kriteria)
                                <tr class="hover">
                                    <td class="text-center font-semibold text-sm">C{{ $loop->iteration }}</td>
                                    <td class="text-center font-semibold text-sm">{{ $kriteria->kriteria }}</td>
                                    <td class="text-center text-sm">{{ $kriteria->bobot }}</td>
                                    <td class="text-center text-sm">{{ Str::title($kriteria->tipe) }}</td>
                                    <td class="text-center">
                                        <div class="flex items-center justify-center gap-1 flex-wrap">
                                            <a href="{{ route('edit-kriteria-bobot', $kriteria->id) }}"
                                                class="btn btn-xs gap-1 bg-warning/20 text-warning hover:bg-warning hover:text-warning-content border-none">
                                                <i class="fas fa-edit text-[10px]"></i> Edit
                                            </a>
                                            <a href="{{ route('sub-kriteria', $kriteria->id) }}"
                                                class="btn btn-xs gap-1 bg-info/20 text-info hover:bg-info hover:text-info-content border-none">
                                                <i class="fas fa-circle-info text-[10px]"></i> Sub Kriteria
                                            </a>
                                            <form id="delete-form-{{ $kriteria->id }}"
                                                action="{{ route('delete-kriteria-bobot', $kriteria->id) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    onclick="confirmDelete('delete-form-{{ $kriteria->id }}')"
                                                    class="btn btn-xs gap-1 bg-error/20 text-error hover:bg-error hover:text-error-content border-none">
                                                    <i class="fas fa-trash-alt text-[10px]"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-base-content/50 py-8">
                                        <i class="fa fa-inbox text-3xl mb-2 block"></i>
                                        Belum ada data kriteria dan bobot.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Perbaikan Bobot Table -->
        <div class="card bg-base-100 shadow-md rounded-2xl">
            <div class="card-body p-0">
                <div class="px-5 pt-5 pb-3">
                    <h3 class="text-base font-bold text-base-content flex items-center gap-2">
                        <i class="fa fa-calculator text-primary text-sm"></i>
                        Perbaikan Bobot
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="table table-zebra">
                        <thead>
                            <tr>
                                <th class="text-center text-xs font-bold uppercase text-base-content/50">Bobot/Kriteria</th>
                                <th class="text-center text-xs font-bold uppercase text-base-content/50">Bobot Kepentingan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kriteria_bobot as $kriteria)
                                <tr class="hover">
                                    <td class="text-center font-semibold text-sm">W{{ $loop->iteration }}</td>
                                    <td class="text-center font-mono text-sm">{{ round($kriteria->bobot / $total_bobot, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center text-base-content/50 py-8">
                                        <i class="fa fa-inbox text-3xl mb-2 block"></i>
                                        Belum ada data bobot.
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




