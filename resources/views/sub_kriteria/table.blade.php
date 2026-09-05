@extends('layouts.app')

@section('title', 'Sub Kriteria')

@section('main')
    <!-- Page Header -->
    <div class="px-6 py-6 pb-2">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-sm breadcrumbs text-primary-content/70 mb-1">
                    <ul>
                        <li><a href="{{ route('home') }}" class="breadcrumb-link"><i class="fa fa-home text-xs"></i></a></li>
                        <li><a href="{{ route('kriteria-bobot') }}" class="breadcrumb-link">Kriteria dan Bobot</a></li>
                        <li>{{ $kriteria->kriteria }}</li>
                    </ul>
                </div>
                <h1 class="text-2xl font-bold text-primary-content">{{ $kriteria->kriteria }}</h1>
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
                    <h3 class="text-base font-bold text-base-content">Data Sub Kriteria</h3>
                    <a href="{{ route('add-sub-kriteria', $kriteria->id) }}" class="btn btn-primary btn-sm gap-1">
                        <i class="fas fa-plus text-xs"></i>
                        Tambah Sub Kriteria
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="table table-zebra">
                        <thead>
                            <tr>
                                <th class="text-center text-xs font-bold uppercase text-base-content/50">No</th>
                                <th class="text-center text-xs font-bold uppercase text-base-content/50">Deskripsi</th>
                                <th class="text-center text-xs font-bold uppercase text-base-content/50">Bobot</th>
                                <th class="text-center text-xs font-bold uppercase text-base-content/50">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sub_kriteria as $sk)
                                <tr class="hover">
                                    <td class="text-center font-semibold text-sm">{{ $loop->iteration }}</td>
                                    <td class="text-center font-semibold text-sm">{{ $sk->desc }}</td>
                                    <td class="text-center text-sm">{{ $sk->rate }}</td>
                                    <td class="text-center">
                                        <div class="flex items-center justify-center gap-1 flex-wrap">
                                            <a href="{{ route('edit-sub-kriteria', $sk->id) }}"
                                                class="btn btn-xs gap-1 bg-warning/20 text-warning hover:bg-warning hover:text-warning-content border-none">
                                                <i class="fas fa-edit text-[10px]"></i> Edit
                                            </a>
                                            <form id="delete-form-{{ $sk->id }}"
                                                action="{{ route('delete-sub-kriteria', $sk->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    onclick="confirmDelete('delete-form-{{ $sk->id }}')"
                                                    class="btn btn-xs gap-1 bg-error/20 text-error hover:bg-error hover:text-error-content border-none">
                                                    <i class="fas fa-trash-alt text-[10px]"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-base-content/50 py-8">
                                        <i class="fa fa-inbox text-3xl mb-2 block"></i>
                                        Belum ada data sub kriteria.
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




