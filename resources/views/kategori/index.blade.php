@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h3>Kategori Komponen</h3>
        <a href="{{ route('kategori.create') }}" class="btn btn-primary">Tambah Kategori</a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Kategori Komponen</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($kategori as $k)
                    <tr>
                        <td>{{ $k->id }}</td>
                        <td>{{ $k->nama_kategori }}</td>
                        <td>
                            <a href="{{ route('kategori.show', $k->id) }}" class="btn btn-info btn-sm">Show</a>
                            <a href="{{ route('kategori.edit', $k->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('kategori.destroy', $k->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Apakah Anda Yakin Menghapus Data ini)" class="btn btn-danger btn-sm">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection