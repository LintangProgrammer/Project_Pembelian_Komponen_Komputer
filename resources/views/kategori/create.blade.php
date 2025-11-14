@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Komponen</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('kategori.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_komponen" class="form-control @error('nama_komponen') is-invalid @enderror"
                            value="{{ old('nama_komponen') }}" required>
                        @error('nama_komponen')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>


                    <div class="mb-3">
                        <label>Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control @error('nama_komponen') is-invalid @enderror"
                            value="{{ old('nama_kategori') }}" required>
                        @error('nama_komponen')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>



                    <div class="d-flex justify-content-between">
                        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection