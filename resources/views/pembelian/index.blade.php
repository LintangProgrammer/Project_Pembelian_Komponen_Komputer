@extends('layouts.dashboard')

@section('content')
    <div class="container mt-4">

        <a href="{{ route('pembelian.create') }}" class="btn btn-primary mb-3">Tambah Pembelian</a>

        <div class="card">
            <div class="card-header">Data Pembelian</div>
            <div class="card-body">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Supplier</th>
                            <th>Kode</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Nama Komponen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pembelian as $p)
                            <tr>
                                <td>{{ $p->supplier->nama_supplier }}</td>
                                <td>{{ $p->kode_pembelian }}</td>
                                <td>{{ $p->tanggal }}</td>
                                <td>{{ $p->jumlah }}</td>
                                <td class="text-end">Rp {{ number_format($p->subtotal, 0, ',', '.') }}</td>
                                <td>{{ $p->nama_komponen}}</td>
                                <td>
                                    <a href="{{ route('pembelian.show', $p->id) }}" class="btn btn-info btn-sm">Show</a>
                                    <a href="{{ route('pembelian.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                    <form action="{{ route('pembelian.destroy', $p->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ini?')"
                                            class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection