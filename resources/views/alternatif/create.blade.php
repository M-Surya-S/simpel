@extends('layouts.app')

@section('title', 'Tambah Alternatif')

@section('main')
    <!-- Page Header -->
    <div class="px-6 py-6 pb-2">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-sm breadcrumbs text-primary-content/70 mb-1">
                    <ul>
                        <li><a href="{{ route('home') }}" class="breadcrumb-link"><i class="fa fa-home text-xs"></i></a></li>
                        <li><a href="{{ route('alternatif') }}" class="breadcrumb-link">Alternatif</a></li>
                        <li>Tambah</li>
                    </ul>
                </div>
                <h1 class="text-2xl font-bold text-primary-content">Tambah Alternatif</h1>
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
            <form action="{{ route('save-alternatif') }}" method="POST">
                @csrf
                <div class="card bg-base-100 shadow-md rounded-2xl">
                    <div class="card-body">
                        <h3 class="text-base font-bold text-base-content mb-4 flex items-center gap-2">
                            <i class="fa fa-user-plus text-primary text-sm"></i>
                            Form Alternatif Baru
                        </h3>

                        <div class="form-control w-full mb-4">
                            <label class="label">
                                <span class="label-text font-semibold">Nama Peserta</span>
                            </label>
                            <input type="text" name="name" placeholder="Masukkan nama peserta"
                                class="input input-bordered w-full" required />
                        </div>

                        @foreach ($kriteria as $k)
                            <div class="form-control w-full mb-4">
                                <label class="label">
                                    <span class="label-text font-semibold">{{ $k->kriteria }}</span>
                                </label>
                                <select name="tipe[{{ $k->id }}]" class="select select-bordered w-full" required>
                                    <option value="" disabled selected>-- Pilih Sub Kriteria --</option>
                                    @foreach ($k->sub_kriteria as $sk)
                                        <option value="{{ $sk->id }}">{{ $sk->desc }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach

                        <div class="flex justify-end gap-2 mt-2">
                            <a href="{{ route('alternatif') }}" class="btn btn-ghost btn-sm">Batal</a>
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




