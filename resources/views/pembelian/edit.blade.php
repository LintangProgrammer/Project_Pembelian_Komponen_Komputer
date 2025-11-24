@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h3>Edit Pembelian</h3>
    <form action="{{ route('pembelian.update', $pembelian->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Kode Pembelian</label>
            <input type="text" name="kode_pembelian" class="form-control" value="{{ $pembelian->kode_pembelian }}" required>
        </div>

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $pembelian->tanggal }}" required>
        </div>

        <div class="mb-3">
            <label>Supplier</label>
            <select name="supplier_id" class="form-control" required>
                @foreach($supplier as $sup)
                    <option value="{{ $sup->id }}" {{ $pembelian->supplier_id == $sup->id ? 'selected' : '' }}>{{ $sup->nama_supplier }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('pembelian.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection