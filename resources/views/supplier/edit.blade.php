@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">

    <h3>Edit Supplier</h3>
    <form action="{{ route ('supplier.update', $supplier->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Supplier</label>
            <input type="text" name="nama_supplier" class="form-control" value="{{ $supplier->nama_supplier }}" required>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" value="{{ $supplier->alamat }}" required>
        </div>

        <div class="mb-3">
            <label>Telepon</label>
            <input type="text" name="telepon" class="form-control" value="{{ $supplier->telepon }}" required>
        </div>

        <button class="btn btn-warning">Update</button>
        <a href="{{ route('supplier.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection