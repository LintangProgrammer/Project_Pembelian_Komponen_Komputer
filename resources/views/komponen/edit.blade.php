@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h3 class="mb-4">Edit Transaksi #{{ $komponen->nama_komponen }}</h3>

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

        <form action="{{ route('komponen.update', $komponen->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Pilih Pelanggan --}}
            <div class="card-body">
                <form action="{{ route('komponen.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Komponen</label>
                        <input type="text" class="form-control @error('nama_komponen') is-invalid @enderror" name="nama_komponen"
                            value="{{ old('nama_komponen') }}" placeholder="komponen Name" required>
                        @error('nama_komponen')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

            <hr>

            <h5>Daftar Produk</h5>

            {{-- Wrapper Produk --}}
            <div id="komponen-wrapper">
                @foreach ($komponen->kategori as $kategori)
                    <div class="row komponen-item mb-3">
                        <div class="col-md-5">
                            <label class="form-label">Komponen</label>
                            <select name="nama_komponen[]" class="form-select komponen-select" required>
                                <option value="">-- Pilih Komponen --</option>
                                @foreach ($komponen as $prod)
                                    <option value="{{ $prod->id }}" data-harga="{{ $prod->harga }}" {{ $prodTrans->id == $prod->id ? 'selected' : '' }}>
                                        {{ $prod->nama_komponen }} - Rp{{ number_format($prod->harga, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Jumlah</label>
                            <input type="number" name="jumlah[]" class="form-control jumlah-input" min="1"
                                value="{{ $prodTrans->pivot->jumlah }}" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Subtotal</label>
                            <input type="text" class="form-control subtotal" readonly
                                value="Rp{{ number_format($prodTrans->pivot->sub_total, 0, ',', '.') }}">
                        </div>

                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-danger btn-remove w-100">×</button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-end mb-3">
                <button type="button" class="btn btn-sm btn-secondary" id="btn-add">+ Tambah Produk</button>
            </div>

            <div class="text-end mb-4">
                <h5>Total Harga: <span id="totalHarga">Rp{{ number_format($transaki->total_harga, 0, ',', '.') }}</span>
                </h5>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary btn-sm">Update Transaksi</button>
            </div>
        </form>
    </div>

    {{-- SCRIPT --}}
    <script>
        function hitungSubtotal() {
            let total = 0;
            document.querySelectorAll('.komponen-item').forEach(item => {
                let select = item.querySelector('.komponen-select');
                let jumlah = item.querySelector('.jumlah-input');
                let subtotalInput = item.querySelector('.subtotal');

                let harga = select.selectedOptions[0]?.getAttribute('data-harga') || 0;
                let sub = parseInt(harga) * parseInt(jumlah.value || 0);

                subtotalInput.value = 'Rp' + sub.toLocaleString('id-ID');
                total += sub;
            });

            document.getElementById('totalHarga').innerText = 'Rp' + total.toLocaleString('id-ID');
        }

        document.addEventListener('input', hitungSubtotal);
        document.addEventListener('change', hitungSubtotal);

        // Tambah komponen baru
        document.getElementById('btn-add').addEventListener('click', function () {
            let wrapper = document.getElementById('komponen-wrapper');
            let newRow = wrapper.firstElementChild.cloneNode(true);

            newRow.querySelectorAll('input').forEach(i => i.value = i.classList.contains('jumlah-input') ? 1 : 'Rp0');
            newRow.querySelector('.komponen-select').value = '';

            wrapper.appendChild(newRow);
            hitungSubtotal();
        });

        // Hapus komponen
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('btn-remove')) {
                let items = document.querySelectorAll('.komponen-item');
                if (items.length > 1) {
                    e.target.closest('.komponen-item').remove();
                    hitungSubtotal();
                }
            }
        });

        document.addEventListener('DOMContentLoaded', hitungSubtotal);
    </script>
@endsection
