@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>Tambah Komponen</h3>

        <form action="{{ route('komponen.store') }}" method="POST" class="mt-3">
            @csrf

            <div class="mb-3">
                <label>Nama Komponen</label>
                <input type="text" name="nama_komponen" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Kategori</label>
                <select name="id_kategori" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('komponen.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection