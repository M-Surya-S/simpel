@extends('layouts.app')

@section('title', 'Tambah Sub Kriteria')

@section('main')
    <!-- Page Header -->
    <div class="px-6 py-6 pb-2">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-sm breadcrumbs text-primary-content/70 mb-1">
                    <ul>
                        <li><a href="{{ route('home') }}" class="breadcrumb-link"><i class="fa fa-home text-xs"></i></a></li>
                        <li><a href="{{ route('kriteria-bobot') }}" class="breadcrumb-link">Kriteria dan Bobot</a></li>
                        <li><a href="{{ route('sub-kriteria', $kriteria->id) }}" class="breadcrumb-link">{{ $kriteria->kriteria }}</a></li>
                        <li>Tambah</li>
                    </ul>
                </div>
                <h1 class="text-2xl font-bold text-primary-content">Tambah Sub Kriteria</h1>
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
        <div class="max-w-2xl mx-auto">
            <form action="{{ route('save-sub-kriteria', $kriteria->id) }}" method="POST">
                @csrf
                <div class="card bg-base-100 shadow-md rounded-2xl">
                    <div class="card-body">
                        <h3 class="text-base font-bold text-base-content mb-4 flex items-center gap-2">
                            <i class="fa fa-plus-circle text-primary text-sm"></i>
                            Form Sub Kriteria Baru
                        </h3>

                        <div class="form-control w-full mb-4">
                            <label class="label">
                                <span class="label-text font-semibold">Deskripsi</span>
                            </label>
                            <input type="text" name="deskripsi" placeholder="Masukkan deskripsi sub kriteria"
                                class="input input-bordered w-full" required />
                        </div>

                        <div class="form-control w-full mb-6">
                            <label class="label">
                                <span class="label-text font-semibold">Bobot</span>
                            </label>
                            <input type="number" name="bobot" placeholder="Masukkan bobot"
                                class="input input-bordered w-full" required />
                        </div>

                        <div class="flex justify-end gap-2">
                            <a href="{{ route('sub-kriteria', $kriteria->id) }}" class="btn btn-ghost btn-sm">Batal</a>
                            <button type="submit" class="btn btn-primary btn-sm gap-1">
                                <i class="fa fa-save text-xs"></i>
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection




