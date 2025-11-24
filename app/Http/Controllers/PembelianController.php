<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Supplier;
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
        return view('pembelian.create', compact('supplier','pembelian'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_pembelian' => 'required|unique:pembelian',
            'tanggal' => 'required|date',
            'supplier_id' => 'required',
        ]);

        Pembelian::create($request->all());

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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembelian $pembelian)
    {
        $pembelian = Pembelian::findOrFail($pembelian->id);
        $supplier = Supplier::all();
        return view('pembelian.edit', compact('pembelian, supplier'));
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
