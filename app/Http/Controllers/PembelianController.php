<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Supplier;
use App\Models\Komponen;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembelian = Pembelian::with('supplier')->latest()->paginate(10);
        return view('pembelian.index', compact('pembelian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $supplier = Supplier::all();
        $pembelian = Pembelian::all();
        $komponen = Komponen::all();
        return view('pembelian.create', compact('supplier','pembelian','komponen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_pembelian' => 'required|unique:pembelians',
            'tanggal' => 'required|date',
            'supplier_id' => 'required',
            'id_komponen.*' => 'required|exists:komponens,id',
            'jumlah.*' => 'required|numeric',
            'subtotal.*' => 'required|numeric',
        ]);

        $totalJumlah = array_sum($request->jumlah ?? []);
        $totalHarga = 0;
        $komponenPivot = [];

        foreach ($request->id_komponen ?? [] as $index => $komponenId) {
            $komponenModel = Komponen::find($komponenId);
            if (! $komponenModel) {
                continue;
            }

            $jumlah = (int) ($request->jumlah[$index] ?? 0);
            $subtotal = $komponenModel->harga * $jumlah;
            $totalHarga += $subtotal;

            $komponenPivot[$komponenId] = [
                'jumlah' => $jumlah,
                'sub_total' => $subtotal,
            ];
        }

        // Create single Pembelian record using kode_pembelian from the request
        $pembelian = Pembelian::create([
            'kode_pembelian' => $request->kode_pembelian,
            'tanggal' => $request->tanggal ?? now(),
            'supplier_id' => $request->supplier_id,
            'jumlah' => $totalJumlah,
            'total_harga' => $totalHarga;

        // If a relationship exists, attach pivot data (this is safe if the relation method exists)
        if (! empty($komponenPivot) && method_exists($pembelian, 'komponens')) {
            $pembelian->komponens()->attach($komponenPivot);
        }

        return redirect()->route('pembelian.index')->with('success', 'Data Pembelian berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembelian $pembelian)
    {
        $pembelian = Pembelian::with('supplier', 'detail_pembelian')->findOrFail($pembelian->id);
        return view('pembelian.show', compact('pembelian'));
    }
    public function edit(Pembelian $pembelian)
    {
        $pembelian = Pembelian::findOrFail($pembelian->id);
        $supplier = Supplier::all();
        return view('pembelian.edit', compact('pembelian', 'supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembelian $pembelian)
    {
        $request->validate([
            'kode_pembelian' => 'required|unique:pembelian,kode_pembelian,' . $pembelian->id,
            'tanggal' => 'required|date',
            'supplier_id' => 'required',
        ]);

        $pembelian = Pembelian::findOrFail($pembelian->id);

        $pembelian->update($request->all());

        return redirect()->route('pembelian.index')->with('success', 'Data Pembelian berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembelian $pembelian)
    {
        Pembelian::findOrFail($pembelian->id)->delete();

        return redirect()->route('pembelian.index')
            ->with('success', 'Data pembelian berhasil dihapus');
    }
}