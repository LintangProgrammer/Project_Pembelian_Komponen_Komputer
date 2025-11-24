@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h3>Tambah Pembelian</h3>

        <form action="{{ route('pembelian.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Kode Pembelian</label>
                <input type="text" name="kode_pembelian" class="form-control">
            </div>

            <div class="mb-3">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control">
            </div>

            <div class="mb-3">
                <label>Supplier</label>
                <select name="supplier_id" class="form-control">
                    <option value="">-- Pilih Supplier --</option>
                    @foreach ($supplier as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_supplier }}</option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection