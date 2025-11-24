@extends('layouts.dashboard')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Detail Komponen</h4>
            </div>
            <div class="card-body">
                <p><strong>Nama Komponen:</strong> {{ $komponen->nama_komponen }}</p>
                <p><strong>Stok:</strong>{{ $komponen->stok }}</p>
                <p><strong>Kategori:</strong> {{ $komponen->kategori->nama_kategori }}</p>
                <p><strong>Harga:</strong> Rp{{ number_format($komponen->harga) }}</p>
                <a href="{{ route('komponen.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection