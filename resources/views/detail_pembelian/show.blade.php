@extends('layouts.dashboard')
@section('content')

<div class="container mt-4">
    <h3>Detail Pembelian</h3>

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Kode Pembelian: {{ $detail_pembelian->pembelian->kode_pembelian }}</h5>
            <p class="card-text"><strong>Komponen:</strong> {{ $detail_pembelian->komponen->nama_komponen }}</p>
            <p class="card-text"><strong>Jumlah:</strong> {{ $detail_pembelian->jumlah }}</p>
            <p class="card-text"><strong>Subtotal:</strong> Rp{{ number_format($detail_pembelian->subtotal) }}</p>
            <a href="{{ route('detail_pembelian.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
@endsection