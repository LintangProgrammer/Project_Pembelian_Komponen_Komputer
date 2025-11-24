@extends('layouts.dashboard')
@section('content')
    <div class="container mt-4">

        <div class="d-flex justify-content-between mb-3">
            <h3>Data Komponen</h3>
            <a href="{{ route('komponen.create') }}" class="btn btn-primary">Tambah Komponen</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama Komponen</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($komponen as $k)
                    <tr>
                        <td>{{ $k->nama_komponen }}</td>
                        <td>{{ $k->stok }}</td>
                        <td>Rp {{ number_format($k->harga) }}</td>
                        <td>{{ $k->kategori->nama_kategori }}</td>
                        <td>
                            <a href="{{ route('komponen.show', $k->id) }}" class="btn btn-info btn-sm">Show</a>
                            <a href="{{ route('komponen.edit', $k->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('komponen.destroy', $k->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Yakin?')" class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection