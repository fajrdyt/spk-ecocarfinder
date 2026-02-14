@extends('layouts.app')

@section('title', 'Dashboard - EcoCarFinder')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">
        <i class="fas fa-home me-2"></i>Dashboard
    </h2>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Total Kriteria</h6>
                            <h2 class="mb-0">{{ \App\Models\Kriteria::count() }}</h2>
                        </div>
                        <i class="fas fa-list-check fa-3x opacity-50"></i>
                    </div>
                </div>
                <div class="card-footer bg-success bg-opacity-75">
                    <a href="{{ route('kriteria.index') }}" class="text-white text-decoration-none">
                        Lihat Detail <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Total Kendaraan</h6>
                            <h2 class="mb-0">{{ \App\Models\Kendaraan::count() }}</h2>
                        </div>
                        <i class="fas fa-car fa-3x opacity-50"></i>
                    </div>
                </div>
                <div class="card-footer bg-info bg-opacity-75">
                    <a href="{{ route('kendaraan.index') }}" class="text-white text-decoration-none">
                        Lihat Detail <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Hasil Ranking</h6>
                            <h2 class="mb-0">Top 5</h2>
                        </div>
                        <i class="fas fa-ranking-star fa-3x opacity-50"></i>
                    </div>
                </div>
                <div class="card-footer bg-warning bg-opacity-75">
                    <a href="{{ route('spk.index') }}" class="text-white text-decoration-none">
                        Lihat Hasil <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Tentang Sistem</h5>
                </div>
                <div class="card-body">
                    <h6 class="text-success"><i class="fas fa-leaf me-2"></i>EcoCarFinder</h6>
                    <p class="mb-3">Sistem Pendukung Keputusan untuk Rekomendasi Kendaraan Paling Ramah Lingkungan Berdasarkan Emisi CO₂</p>
                    
                    <h6 class="mt-4">Metode: Simple Additive Weighting (SAW)</h6>
                    <p class="text-muted">
                        Metode SAW adalah metode penjumlahan terbobot yang mencari penjumlahan terbobot dari rating kinerja pada setiap alternatif pada semua kriteria. 
                        Metode ini membutuhkan proses normalisasi matriks keputusan ke skala yang dapat diperbandingkan dengan semua rating alternatif yang ada.
                    </p>

                    <h6 class="mt-4">Kriteria Penilaian:</h6>
                    <ul>
                        <li><strong>Emisi CO₂ (g/km)</strong> - Semakin rendah semakin baik (Cost)</li>
                        <li><strong>Konsumsi Bahan Bakar (L/100km)</strong> - Semakin rendah semakin baik (Cost)</li>
                        <li><strong>Efisiensi Bahan Bakar (mpg)</strong> - Semakin tinggi semakin baik (Benefit)</li>
                        <li><strong>Ukuran Mesin (L)</strong> - Semakin kecil semakin baik (Cost)</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection