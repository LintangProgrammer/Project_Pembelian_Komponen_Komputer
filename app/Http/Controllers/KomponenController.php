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
        $kategori = Kategori::all();
        $komponen = Komponen::with(['kategori'])->latest()->get();
        return view('komponen.index', compact('komponen','kategori'));
    }

    public function create()
    {
        $komponen = Komponen::all();
        $kategori = Kategori::all();
        return view('komponen.create', compact( 'kategori','komponen'));
    }

    public function store(Request $request)
    {
          $request->validate([
            'nama_komponen' => 'required|string',
            'stok'          => 'required|integer|min:0',
            'harga'         => 'required|numeric',
            'id_kategori'   => 'required|exists:kategoris,id',
        ]);
        Komponen::create($request->all());
        return redirect()->route('komponen.index')->with('success', 'Komponen berhasil disimpan!');
    }

    public function show($id)
    {
        $komponen = Komponen::with(['kategori'])->findOrFail($id);
        return view('komponen.show', compact('komponen'));
    }

    public function edit($id)
    {
        $kategori = Kategori::all();
        $komponen = Komponen::with('kategori')->findOrFail($id);
        return view('komponen.edit', compact('komponen','kategori'));
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
        $komponen = Komponen::with('kategori')->findOrFail($id);
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