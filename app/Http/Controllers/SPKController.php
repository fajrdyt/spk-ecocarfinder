<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kendaraan;
use App\Models\Kriteria;

class SPKController extends Controller
{
    // Menampilkan hasil perangkingan SAW
    public function index()
    {
        $kendaraan = Kendaraan::all();
        $kriteria = Kriteria::all();

        if ($kendaraan->isEmpty() || $kriteria->isEmpty()) {
            return view('spk.index')->with('error', 'Data kendaraan atau kriteria kosong!');
        }

        // Step 1: Normalisasi matriks keputusan
        $normalized = $this->normalisasiMatriks($kendaraan, $kriteria);

        // Step 2: Hitung nilai preferensi (perkalian bobot dengan normalisasi)
        $hasil = $this->hitungPreferensi($normalized, $kriteria);

        // Step 3: Urutkan berdasarkan nilai tertinggi dan ambil top 5
        $ranking = collect($hasil)->sortByDesc('nilai_preferensi')->take(5)->values();

        return view('spk.index', compact('ranking'));
    }

    // Fungsi normalisasi matriks (menggunakan perulangan)
    private function normalisasiMatriks($kendaraan, $kriteria)
    {
        $normalized = [];

        // Hitung nilai min dan max untuk setiap kriteria
        $minMax = [];
        foreach ($kriteria as $k) {
            if ($k->kode_kriteria == 'C1') {
                $values = $kendaraan->pluck('co2_emissions');
            } elseif ($k->kode_kriteria == 'C2') {
                $values = $kendaraan->pluck('fuel_consumption_comb');
            } elseif ($k->kode_kriteria == 'C3') {
                $values = $kendaraan->pluck('fuel_consumption_mpg');
            } elseif ($k->kode_kriteria == 'C4') {
                $values = $kendaraan->pluck('engine_size');
            }

            $minMax[$k->kode_kriteria] = [
                'min' => $values->min(),
                'max' => $values->max(),
                'jenis' => $k->jenis
            ];
        }

        // Normalisasi setiap kendaraan menggunakan perulangan
        foreach ($kendaraan as $v) {
            $norm = [
                'id' => $v->id,
                'merk' => $v->merk,
                'model' => $v->model
            ];

            foreach ($kriteria as $k) {
                $nilai = 0;
                
                // Ambil nilai aktual berdasarkan kriteria
                if ($k->kode_kriteria == 'C1') {
                    $nilai = $v->co2_emissions;
                } elseif ($k->kode_kriteria == 'C2') {
                    $nilai = $v->fuel_consumption_comb;
                } elseif ($k->kode_kriteria == 'C3') {
                    $nilai = $v->fuel_consumption_mpg;
                } elseif ($k->kode_kriteria == 'C4') {
                    $nilai = $v->engine_size;
                }

                // Normalisasi berdasarkan jenis kriteria
                if ($k->jenis == 'benefit') {
                    // Untuk benefit: nilai/max
                    $norm[$k->kode_kriteria] = $nilai / $minMax[$k->kode_kriteria]['max'];
                } else {
                    // Untuk cost: min/nilai
                    $norm[$k->kode_kriteria] = $minMax[$k->kode_kriteria]['min'] / $nilai;
                }
            }

            $normalized[] = $norm;
        }

        return $normalized;
    }

    // Fungsi hitung nilai preferensi (menggunakan perulangan)
    private function hitungPreferensi($normalized, $kriteria)
    {
        $hasil = [];

        // Hitung nilai preferensi untuk setiap alternatif
        foreach ($normalized as $norm) {
            $nilaiPreferensi = 0;

            // Kalikan nilai normalisasi dengan bobot kriteria
            foreach ($kriteria as $k) {
                $bobotDesimal = $k->bobot / 100; // Konversi bobot ke desimal
                $nilaiPreferensi += $norm[$k->kode_kriteria] * $bobotDesimal;
            }

            $hasil[] = [
                'id' => $norm['id'],
                'merk' => $norm['merk'],
                'model' => $norm['model'],
                'nilai_preferensi' => round($nilaiPreferensi, 4)
            ];
        }

        return $hasil;
    }
}