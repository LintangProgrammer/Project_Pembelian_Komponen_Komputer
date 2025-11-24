@extends('layouts.dashboard')
@section('content')

<div class="container mt-4">

    <h3>Edit Detail Pembelian</h3>

    <form action="{{ route ('detail_pembelian.update', $detail_pembelian->id) }}" method="POST" class="mt-3">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Kode Pembelian</label>
            <select name="pembelian_id" class="form-control" required>
                @foreach ($pembelian as $p )
                <option value="{{ $p->id }}" {{  $p->id ==$detail_pembelian->pembelian_id ? 'selected' : '' }}>
                    {{ $p->kode_pembelian }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Komponen</label>
            <select name="komponen_id" class="form-control" required>
                @foreach ($komponen as $k )
                <option value="{{ $k->id }}" {{ $k->id == $detail_pembelian->komponen_id ? 'selected' : '' }}>
                    {{ $k->nama_komponen }} - Rp {{ number_format($k->harga) }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" value="{{ $detail_pembelian->jumlah }}" required>
        </div>

        <button class="btn btn-warning">Update</button>
    </form>
</div>
@endsection