@extends ('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h3>Data Detail Pembelian</h3>
        <a href="{{ route('detail_pembelian.create') }}" class="btn btn-primary">Tambah Detail Pembelian</a>
    </div>

    <table class="table table-bordered table-stripped">
        <thead>
            <tr>
                <th>Kode Pembelian</th>
                <th>Komponen</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($detail_pembelian as $d )
            <tr>
                <td>{{ $d->id }}</td>
                <td>{{ $d->pembelian->kode_pembelian }}</td>
                <td>{{ $d->komponen->nama_komponen }}</td>
                <td>{{ $d->jumlah }}</td>
                <td>Rp{{ number_format($d->subtotal) }}</td>

                <td>
                    <a href="{{ route('detail_pembelian.show', $d->id) }}" class="btn btn-info btn-sm">Show</a>
                    <a href="{{ route('detail_pembelian.edit', $d->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('detail_pembelian.destroy', $d->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ini?')" class="btn btn-danger btn-sm">
                            Delete
                        </button>
                    </form>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection