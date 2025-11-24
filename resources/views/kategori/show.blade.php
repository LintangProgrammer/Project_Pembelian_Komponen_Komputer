@extends('layouts.dashboard')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Detail Kategori</h4>
            </div>
            <div class="card-body">
                <p><strong>Kategori:</strong> {{ $kategori->nama_kategori }}</p>
                <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection