@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h3>Detail Pembelian</h3>
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Kode Pembelian: {{ $pembelian->kode_pembelian }}</h5>
            <p class="card-text"><strong>Tanggal:</strong> {{ $pembelian->tanggal }}</p>
            <p class="card-text"><strong>Supplier:</strong> {{ $pembelian->supplier->nama_supplier }}</p>
            <a href="{{ route('pembelian.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
    <div class="mt-4">
        <h4>Detail Komponen yang Dibeli</h4>
        <table class="table table-bordered mt-2">
            <thead>
                <tr>
                    <th>Komponen</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pembelian->detail_pembelian as $detail)
                <tr>
                    <td>{{ $detail->komponen->nama_komponen }}</td>
                    <td>{{ $detail->jumlah }}</td>
                    <td>Rp{{ number_format($detail->subtotal) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection