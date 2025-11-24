@extends('layouts.dashboard')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between mb-3">
            <h3>Data Supplier</h3>
            <a href="{{ route('supplier.create') }}" class="btn btn-primary">Tambah Supplier</a>
        </div>

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-stripped">
            <thead>
                <tr>
                    <th>Nama Supplier</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($supplier as $s )
                <td>{{ $s->id }}</td>
                <td>{{ $s->nama_supplier }}</td>
                <td>{{ $s->alamat }}</td>
                <td>{{ $s->telepon }}</td>
                <td>
                    <a href="{{ route('supplier.show', $s->id) }}" class="btn btn-info btn-sm">Show</a>
                    <a href="{{ route('supplier.edit', $s->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('supplier.destroy', $s->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ini?')" class="btn btn-danger btn-sm">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection