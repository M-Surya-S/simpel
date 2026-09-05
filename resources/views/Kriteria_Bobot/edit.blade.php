@extends('layouts.app')

@section('title', 'Edit Kriteria dan Bobot')

@section('main')
    <!-- Page Header -->
    <div class="px-6 py-6 pb-2">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-sm breadcrumbs text-primary-content/70 mb-1">
                    <ul>
                        <li><a href="{{ route('home') }}" class="breadcrumb-link"><i class="fa fa-home text-xs"></i></a></li>
                        <li><a href="{{ route('kriteria-bobot') }}" class="breadcrumb-link">Kriteria dan Bobot</a></li>
                        <li>Edit</li>
                    </ul>
                </div>
                <h1 class="text-2xl font-bold text-primary-content">Edit Kriteria dan Bobot</h1>
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
            <form action="{{ route('update-kriteria-bobot', $kriteria_bobot->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="card bg-base-100 shadow-md rounded-2xl">
                    <div class="card-body">
                        <h3 class="text-base font-bold text-base-content mb-4 flex items-center gap-2">
                            <i class="fa fa-edit text-warning text-sm"></i>
                            Edit Kriteria
                        </h3>

                        <div class="form-control w-full mb-4">
                            <label class="label">
                                <span class="label-text font-semibold">Kriteria</span>
                            </label>
                            <input type="text" name="kriteria" value="{{ $kriteria_bobot->kriteria }}"
                                class="input input-bordered w-full" required />
                        </div>

                        <div class="form-control w-full mb-4">
                            <label class="label">
                                <span class="label-text font-semibold">Bobot</span>
                            </label>
                            <input type="number" name="bobot" value="{{ $kriteria_bobot->bobot }}"
                                class="input input-bordered w-full" required />
                        </div>

                        <div class="form-control w-full mb-6">
                            <label class="label">
                                <span class="label-text font-semibold">Tipe</span>
                            </label>
                            <select name="tipe" class="select select-bordered w-full" required>
                                <option disabled {{ $kriteria_bobot->tipe ? '' : 'selected' }}>-- Pilih Tipe --</option>
                                <option value="benefit" {{ $kriteria_bobot->tipe == 'benefit' ? 'selected' : '' }}>Benefit</option>
                                <option value="cost" {{ $kriteria_bobot->tipe == 'cost' ? 'selected' : '' }}>Cost</option>
                            </select>
                        </div>

                        <div class="flex justify-end gap-2">
                            <a href="{{ route('kriteria-bobot') }}" class="btn btn-ghost btn-sm">Batal</a>
                            <button type="submit" class="btn btn-primary btn-sm gap-1">
                                <i class="fa fa-save text-xs"></i>
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection




