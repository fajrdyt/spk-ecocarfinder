<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;

class KriteriaController extends Controller
{
    // Menampilkan daftar kriteria (READ)
    public function index()
    {
        $kriteria = Kriteria::all();
        return view('kriteria.index', compact('kriteria'));
    }

    // Menampilkan form tambah kriteria (CREATE)
    public function create()
    {
        return view('kriteria.create');
    }

    // Menyimpan kriteria baru (STORE)
    public function store(Request $request)
    {
        $request->validate([
            'kode_kriteria' => 'required|unique:kriteria',
            'nama_kriteria' => 'required',
            'bobot' => 'required|numeric|min:0|max:100',
            'jenis' => 'required|in:benefit,cost'
        ]);

        Kriteria::create($request->all());
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil ditambahkan!');
    }

    // Menampilkan form edit kriteria (EDIT)
    public function edit($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        return view('kriteria.edit', compact('kriteria'));
    }

    // Update kriteria (UPDATE)
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_kriteria' => 'required|unique:kriteria,kode_kriteria,'.$id,
            'nama_kriteria' => 'required',
            'bobot' => 'required|numeric|min:0|max:100',
            'jenis' => 'required|in:benefit,cost'
        ]);

        $kriteria = Kriteria::findOrFail($id);
        $kriteria->update($request->all());
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diupdate!');
    }

    // Hapus kriteria (DELETE)
    public function destroy($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $kriteria->delete();
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil dihapus!');
    }
}