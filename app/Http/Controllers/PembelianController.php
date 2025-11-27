<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Supplier;
use App\Models\Komponen;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
    $pembelian = Pembelian::with(['supplier', 'detailpembelian.komponen'])->latest()->get();
    return view('pembelian.index', compact('pembelian'));
}


public function create() {
    $supplier = Supplier::all();
    $komponen = Komponen::all();
    return view('pembelian.create', compact('supplier','komponen'));
}

public function store(Request $request) {
    $request->validate([
        'supplier_id' => 'required|exists:suppliers,id',
        'tanggal' => 'required|date',
        'items.*.komponen_id' => 'required|exists:komponens,id',
        'items.*.jumlah' => 'required|integer|min:1'
    ]);

    DB::transaction(function () use ($request) {

        // generate kode
        $kode = 'BL'.date('Ymd').str_pad(Pembelian::count()+1, 4, '0', STR_PAD_LEFT);

        // simpan header pembelian
        $pembelian = Pembelian::create([
            'kode_pembelian' => $kode,
            'tanggal'        => $request->tanggal,
            'supplier_id'    => $request->supplier_id,
        ]);

        $total = 0;

        foreach ($request->items as $item) {

            $komponen = Komponen::find($item['komponen_id']);
            $subtotal = $komponen->harga * $item['jumlah'];
            $total += $subtotal;

            $pembelian->detailpembelian()->create([
                'komponen_id' => $item['komponen_id'],
                'jumlah'      => $item['jumlah'],
                'harga'       => $komponen->harga,
                'subtotal'    => $subtotal,
            ]);

            // Update stok
            $komponen->increment('stok', $item['jumlah']);
        }

        // simpan total di tabel pembelian
        $pembelian->update(['total' => $total]);
    });

    return redirect()->route('pembelian.index')->with('success','Pembelian berhasil');
}

public function show($id) {
    $pembelian = Pembelian::with(['supplier', 'detailpembelian.komponen'])->findOrFail($id);
    return view('pembelian.show', compact('pembelian'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {
    $pembelian = Pembelian::with('detailpembelian.komponen')->findOrFail($id);
    $supplier  = Supplier::all();
    $komponen  = Komponen::all();

    return view('pembelian.edit', compact('pembelian','supplier','komponen'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'supplier_id' => 'required|exists:suppliers,id',
        'tanggal' => 'required|date',
        'items.*.komponen_id' => 'required|exists:komponens,id',
        'items.*.jumlah' => 'required|integer|min:1'
    ]);

    DB::transaction(function () use ($request, $id) {

        $pembelian = Pembelian::with('detailpembelian')->findOrFail($id);

        // 1. Kembalikan stok lama
        foreach ($pembelian->detailpembelian as $d) {
            $komponen = Komponen::find($d->komponen_id);
            $komponen->decrement('stok', $d->jumlah);
        }

        // 2. Hapus detail lama
        $pembelian->detailpembelian()->delete();

        // 3. Update pembelian
        $pembelian->update([
            'supplier_id' => $request->supplier_id,
            'tanggal' => $request->tanggal,
        ]);

        // 4. Masukkan detail baru
        foreach ($request->items as $item) {
            $komponen = Komponen::find($item['komponen_id']);
            $subtotal = $komponen->harga * $item['jumlah'];

            // insert detail
            $pembelian->detailpembelian()->create([
                'komponen_id' => $item['komponen_id'],
                'jumlah'      => $item['jumlah'],
                'subtotal'    => $subtotal
            ]);

            // update stok baru
            $komponen->increment('stok', $item['jumlah']);
        }
    });

    return redirect()->route('pembelian.index')
                     ->with('success', 'Pembelian berhasil diperbarui');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    DB::transaction(function () use ($id) {
        $pembelian = Pembelian::with('detailpembelian')->findOrFail($id);

        // Kembalikan stok
        foreach ($pembelian->detailpembelian as $d) {
            $komponen = Komponen::find($d->komponen_id);
            $komponen->decrement('stok', $d->jumlah);
        }

        // Hapus detail
        $pembelian->detailpembelian()->delete();

        // Hapus pembelian
        $pembelian->delete();
    });

    return redirect()->route('pembelian.index')
                     ->with('success','Data pembelian berhasil dihapus');
}

}