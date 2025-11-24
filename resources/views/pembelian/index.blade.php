@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h3>Data Pembelian</h3>
        <a href="{{ route ('pembelian.create') }}" class="btn btn-primary">Tambah Data Pembelian</a>
    </div>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Tanggal</th>
                <th>Supplier</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($pembelian as $p)
            <tr>
                <td>{{ $p->kode_pembelian }}</td>
                <td>{{ $p->tanggal }}</td>
                <td>{{ $p->supplier->nama_suppluer }}</td>

                <td>
                    <a href="{{ route('pembelian.show', $p->id) }}" class="btn btn-info btn-sm">Show</a>
                    <a href="{{ route('pembelian.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('pembelian.destroy', $p->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ini?')" class="btn btn-danger btn-sm">
                            Delete
                        </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection