<?php
namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Komponen;
use App\Models\Pembelian;
use Illuminate\Http\Request;

class KomponenController extends Controller
{
    public function index()
    {
        $komponen = Komponen::with(['kategori'])->latest()->get();
        return view('komponen.index', compact('komponen'));
    }

    public function create()
    {
        $komponen = Komponen::all();
        return view('komponen.create', compact('komponen'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_komponen' => 'required',
            'stok'          => 'required|integer|min:0',
            'harga'         => 'required|numeric',
            'kategori_id'   => 'required|exists:kategoris,id',
        ]);
        return redirect()->route('komponen.index')->with('success', 'Komponen berhasil disimpan!');
    }

    public function show($id)
    {
        $komponen = Komponen::with(['kategoris'])->findOrFail($id);
        return view('komponen.show', compact('komponen'));
    }

    public function edit($id)
    {
        $komponen = Komponen::with('kategoris')->findOrFail($id);
        return view('komponen.edit', compact('komponen', 'pelanggan', 'produk'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_komponen' => 'required',
            'stok'          => 'required|integer|min:0',
            'harga'         => 'required|numeric',
            'kategori_id'   => 'required|exists:kategoris,id',
        ]);

        $komponen = Komponen::findOrFail($id);

        // update data komponen
        $komponen->nama_komponen = $validated['nama_komponen'];
        $komponen->stok = $validated['stok'];
        $komponen->harga = $validated['harga'];
        $komponen->kategori_id = $validated['kategori_id'];
        $komponen->save();

        return redirect()->route('komponen.index')->with('success', 'Komponen berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $komponen = Komponen::with('kategoris')->findOrFail($id);
        // Hapus komponen utama
        $komponen->delete();

        return redirect()->route('komponen.index')->with('success', 'Komponen berhasil dihapus dan stok dikembalikan!');
    }


    public function search(Request $request)
    {
        $query     = $request->query('query');
        $komponen = Komponen::with('kategori')
            ->where('kode_komponen', 'like', "%$query%")
            ->get();

        return response()->json($komponen);
    }

}