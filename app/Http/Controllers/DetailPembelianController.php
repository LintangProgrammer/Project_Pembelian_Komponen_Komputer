<?php

namespace App\Http\Controllers;
use App\Models\Pembelian;
use App\Models\Komponen;
use App\Models\detail_pembelian;
use Illuminate\Http\Request;

class DetailPembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detail_pembelian = detail_pembelian::with(['pembelian','komponen'])->paginate();
        return view('detail_pembelian.index', compact('detail_pembelian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pembelian = Pembelian::all();
        $komponen = Komponen::all();
        return view('detail_pembelian.create', compact('pembelian', 'komponen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pembelian_id' => 'required|exists:pembelians,id',
            'komponen_id' => 'required|exists:komponens,id',
            'jumlah' => 'required|integer|min:1',
            'subtotal' => 'required|numeric|min:0'
        ]);

        detail_pembelian::create($request->all());
        return redirect()->route('detail_pembelian.index')->with('success', 'Detail Pembelian berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(detail_pembelian $detail_pembelian)
    {
        $detail_pembelian = detail_pembelian::with(['pembelian', 'komponen'])->findOrFail($detail_pembelian->id);
        return view('detail_pembelian.show', compact('detail_pembelian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(detail_pembelian $detail_pembelian)
    {
        $pembelian = Pembelian::all();
        $komponen = Komponen::all();
        return view('detail_pembelian.edit', compact('detail_pembelian', 'pembelian', 'komponen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, detail_pembelian $detail_pembelian)
    {
        $request->validate([
            'pembelian_id' => 'required|exists:pembelians,id',
            'komponen_id' => 'required|exists:komponens,id',
            'jumlah' => 'required|integer|min:1',
            'subtotal' => 'required|numeric|min:0'
        ]);

        $detail_pembelian->update($request->all());
        return redirect()->route('detail_pembelian.index')->with('success', 'Detail Pembelian berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(detail_pembelian $detail_pembelian)
    {
        $detail_pembelian->delete();
        return redirect()->route('detail_pembelian.index')->with('success', 'Detail Pembelian berhasil dihapus!');
    }
}
