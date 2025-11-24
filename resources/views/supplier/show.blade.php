@extends ('layouts.app')
@section('content')
<div class="container py-4">
    <h3>Detail Supplier</h3>
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Nama Supplier: {{ $supplier->nama_supplier }}</h5>
            <p class="card-text"><strong>Alamat:</strong> {{ $supplier->alamat }}</p>
            <p class="card-text"><strong>Telepon:</strong> {{ $supplier->telepon }}</p>
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('supplier.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection