@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Daftar Kategori</h3>
            <a href="{{ route('kategori.create') }}" class="btn btn-primary"> Tambah Data Kategori</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>

                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @forelse ($kategori as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->nama_kategori }}</td>

                        <td>
                            <form action="{{ route('kategori.destroy', $data->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('kategori.show', $data->id) }}" class="btn btn-sm btn-outline-dark">Show</a>
                                <a href="{{ route('kategori.edit', $data->id) }}"
                                    class="btn btn-sm btn-outline-success">Edit</a>
                                <button type="submit" onsubmit="return confirm('Are You Sure ?');"
                                    class="btn btn-sm btn-danger">Delete</button>
                        </td>
                        </form>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data kategori</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection