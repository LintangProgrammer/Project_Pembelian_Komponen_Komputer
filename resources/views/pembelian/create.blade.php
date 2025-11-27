@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h3 class="mb-4">Tambah Transaksi Baru</h3>

        {{-- Notifikasi Error --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('pembelian.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label>Supplier</label>
                        <select name="supplier_id" class="border p-2 w-full" required>
                            @foreach($supplier as $s)
                                <option value="{{ $s->id }}">{{ $s->nama_supplier }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" required class="border p-2 w-full">
                    </div>

                    <table class="w-full border" id="itemTable">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="p-2">Komponen</th>
                                <th class="p-2">Harga</th>
                                <th class="p-2">Jumlah</th>
                                <th class="p-2">Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="item-row">
                                <td>
                                    <select name="items[0][komponen_id]" class="komponen-select border w-full p-2" required>
                                        <option value="">Pilih Komponen</option>
                                        @foreach($komponen as $k)
                                            <option value="{{ $k->id }}" data-harga="{{ $k->harga }}">
                                                {{ $k->nama_komponen }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="text" class="harga border w-full p-2" readonly></td>
                                <td><input type="number" name="items[0][jumlah]" class="jumlah border w-full p-2" min="1" required></td>
                                <td><input type="text" class="subtotal border w-full p-2" readonly></td>
                                <td><button type="button" class="text-red-600 remove-row">Hapus</button></td>
                            </tr>
                        </tbody>
                    </table>

                    <button type="button" id="addRow" class="mt-2 bg-blue-600 text-white px-4 py-2">+ Tambah Item</button>
                    <button type="submit" class="mt-4 bg-green-600 text-white px-6 py-2">Simpan Pembelian</button>
                </form>

                <script>
                    let index = 1;
                    document.getElementById('addRow').onclick = function () {
                        const table = document.getElementById('itemTable').getElementsByTagName('tbody')[0];
                        const row = table.querySelector('.item-row').cloneNode(true);
                        row.querySelectorAll('input, select').forEach(el => {
                            el.name = el.name.replace(/\[\d+\]/, '[' + index + ']');
                            el.value = '';
                        });
                        table.appendChild(row);
                        index++;
                    };

                    document.addEventListener('change', function (e) {
                        if (e.target.classList.contains('komponen-select')) {
                            const harga = e.target.selectedOptions[0].dataset.harga;
                            e.target.closest('tr').querySelector('.harga').value = harga;
                        }
                    });

                    document.addEventListener('input', function (e) {
                        if (e.target.classList.contains('jumlah')) {
                            const row = e.target.closest('tr');
                            const harga = row.querySelector('.harga').value;
                            const jumlah = e.target.value;
                            row.querySelector('.subtotal').value = harga * jumlah;
                        }
                    });

                    document.addEventListener('click', function (e) {
                        if (e.target.classList.contains('remove-row') && document.querySelectorAll('.item-row').length > 1) {
                            e.target.closest('tr').remove();
                        }
                    });
                </script>
@endsection