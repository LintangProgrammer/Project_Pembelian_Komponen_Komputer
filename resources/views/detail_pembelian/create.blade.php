@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h3>Tambah Detail Pembelian</h3>
    <form action="{{ route ('detail_pembelian.store') }} " method="POST" class="mt-3">
        @csrf 

        <div class="mb-3">
            <label> Kode Pembelian</label>
            <select name="pembelian_id" class="form-control" required>
                <option value="">-- Pilih --</option>
                @foreach ($pembelian as $p )
                <option value="{{ $p->id }}">{{ $p->kode_pembelian }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Komponen</label>
            <select name="komponen_id" class="form-control" required>
                <option value="">-- pilih --</option>
                @foreach ($komponen as $k )
                <option value="{{ $k->id }}">{{ $k->nama_komponen }} - Rp {{ number_format($k->harga) }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('detail_pembelian.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection