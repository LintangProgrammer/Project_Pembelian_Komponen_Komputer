<?php
namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KategoriController extends Controller {
    public function index() {
        $kategori = Kategori::all();
        return view('kategori.index', compact('kategori'));
    }

    public function create() { 
     $kategori = Kategori::all();
    return view('kategori.create');
    }

    public function store(Request $request) {
        $kategori = Kategori::all();
      $validated = $request->validate([
        'nama_kategori' => 'required|string|max:255'
      ]);
        Kategori::create($validated);
        return redirect()->route('kategori.index')->with('success','Kategori ditambah');
    }

    public function edit($id) {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function show($id)
{
    $kategori = Kategori::findOrFail($id);
    return view('kategori.show', compact('kategori'));
}

    public function update(Request $request, $id) {
        $request->validate(['nama_kategori' => 'required']);
        Kategori::findOrFail($id)->update($request->all());
        return redirect()->route('kategori.index')->with('success','Kategori diupdate');
    }

    public function destroy($id) {
        Kategori::findOrFail($id)->delete();
        return back()->with('success','Kategori dihapus');
    }
}