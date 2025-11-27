<?php
namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Komponen;;
use Illuminate\Http\Request;

class KomponenController extends Controller
{
    // app/Http/Controllers/KomponenController.php
public function index() {
    $komponen = Komponen::with('kategori')->get();
    return view('komponen.index', compact('komponen'));
}

public function create() {
    $kategori = Kategori::all();
    return view('komponen.create', compact('kategori'));
}

public function store(Request $request) {
   $validated = $request->validate([
        'nama_komponen' => 'required',
        'stok' => 'required|integer',
        'harga' => 'required|numeric',
        'kategori_id' => 'required|exists:kategoris,id',
    ]);
    Komponen::create($request->all());
    return redirect()->route('komponen.index');
}
public function edit($id) {
    $komponen = Komponen::findOrFail($id);
    $kategori = Kategori::all();
    return view('komponen.edit', compact('komponen', 'kategori'));
}

public function show($id)
{
    $komponen = Komponen::findOrFail($id);
    return view('komponen.show', compact('komponen'));
}

public function update(Request $request, $id) {
    $request->validate([
        'nama_komponen' => 'required',
        'stok' => 'required|integer',
        'harga' => 'required|numeric',
        'kategori_id' => 'required'
    ]);
    Komponen::findOrFail($id)->update($request->all());
    return redirect()->route('komponen.index');
}
public function destroy($id) {
    Komponen::findOrFail($id)->delete();
    return view('komponen.index');
} 
}