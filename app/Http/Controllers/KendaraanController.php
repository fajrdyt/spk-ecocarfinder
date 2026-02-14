<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kendaraan;

class KendaraanController extends Controller
{
    // Menampilkan daftar kendaraan (READ)
    public function index()
    {
        $kendaraan = Kendaraan::all();
        return view('kendaraan.index', compact('kendaraan'));
    }

    // Menampilkan form tambah kendaraan (CREATE)
    public function create()
    {
        return view('kendaraan.create');
    }

    // Menyimpan kendaraan baru (STORE)
    public function store(Request $request)
    {
        $request->validate([
            'merk' => 'required',
            'model' => 'required',
            'engine_size' => 'required|numeric',
            'cylinders' => 'required|integer',
            'fuel_consumption_comb' => 'required|numeric',
            'fuel_consumption_mpg' => 'required|numeric',
            'co2_emissions' => 'required|integer'
        ]);

        Kendaraan::create($request->all());
        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil ditambahkan!');
    }

    // Menampilkan form edit kendaraan (EDIT)
    public function edit($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        return view('kendaraan.edit', compact('kendaraan'));
    }

    // Update kendaraan (UPDATE)
    public function update(Request $request, $id)
    {
        $request->validate([
            'merk' => 'required',
            'model' => 'required',
            'engine_size' => 'required|numeric',
            'cylinders' => 'required|integer',
            'fuel_consumption_comb' => 'required|numeric',
            'fuel_consumption_mpg' => 'required|numeric',
            'co2_emissions' => 'required|integer'
        ]);

        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->update($request->all());
        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil diupdate!');
    }

    // Hapus kendaraan (DELETE)
    public function destroy($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->delete();
        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil dihapus!');
    }
}