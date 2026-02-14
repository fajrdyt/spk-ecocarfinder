@extends('layouts.app')

@section('title', 'Hasil Perangkingan - EcoCarFinder')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2><i class="fas fa-ranking-star me-2"></i>Hasil Perangkingan Kendaraan Ramah Lingkungan</h2>
        <p class="text-muted">Menggunakan Metode Simple Additive Weighting (SAW)</p>
    </div>

    @if(isset($error))
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle me-2"></i>{{ $error }}
        </div>
    @else
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-trophy me-2"></i>Top 5 Kendaraan Terbaik</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="10%" class="text-center">Peringkat</th>
                                <th>Merk</th>
                                <th>Model</th>
                                <th width="20%" class="text-center">Nilai Preferensi</th>
                                <th width="15%" class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ranking as $index => $r)
                            <tr>
                                <td class="text-center">
                                    @if($index == 0)
                                        <span class="badge badge-rank bg-warning text-dark">
                                            <i class="fas fa-crown"></i> #{{ $index + 1 }}
                                        </span>
                                    @elseif($index == 1)
                                        <span class="badge badge-rank bg-secondary">
                                            <i class="fas fa-medal"></i> #{{ $index + 1 }}
                                        </span>
                                    @elseif($index == 2)
                                        <span class="badge badge-rank" style="background-color: #cd7f32;">
                                            <i class="fas fa-medal"></i> #{{ $index + 1 }}
                                        </span>
                                    @else
                                        <span class="badge badge-rank bg-primary">
                                            #{{ $index + 1 }}
                                        </span>
                                    @endif
                                </td>
                                <td><strong>{{ $r['merk'] }}</strong></td>
                                <td>{{ $r['model'] }}</td>
                                <td class="text-center">
                                    <h5 class="mb-0">
                                        <span class="badge bg-success">{{ $r['nilai_preferensi'] }}</span>
                                    </h5>
                                </td>
                                <td class="text-center">
                                    @if($index == 0)
                                        <span class="badge bg-success">
                                            <i class="fas fa-leaf me-1"></i>Sangat Direkomendasikan
                                        </span>
                                    @elseif($index <= 2)
                                        <span class="badge bg-info">
                                            <i class="fas fa-thumbs-up me-1"></i>Direkomendasikan
                                        </span>
                                    @else
                                        <span class="badge bg-primary">
                                            <i class="fas fa-check me-1"></i>Baik
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Keterangan Metode SAW</h5>
                    </div>
                    <div class="card-body">
                        <h6>Rumus Perhitungan:</h6>
                        <ol>
                            <li><strong>Normalisasi:</strong>
                                <ul>
                                    <li>Untuk kriteria <strong>Benefit</strong>: r<sub>ij</sub> = x<sub>ij</sub> / max(x<sub>ij</sub>)</li>
                                    <li>Untuk kriteria <strong>Cost</strong>: r<sub>ij</sub> = min(x<sub>ij</sub>) / x<sub>ij</sub></li>
                                </ul>
                            </li>
                            <li><strong>Nilai Preferensi:</strong> V<sub>i</sub> = Σ (w<sub>j</sub> × r<sub>ij</sub>)</li>
                        </ol>

                        <h6 class="mt-3">Keterangan:</h6>
                        <ul class="mb-0">
                            <li>r<sub>ij</sub> = Nilai rating kinerja ternormalisasi</li>
                            <li>x<sub>ij</sub> = Nilai atribut yang dimiliki dari setiap kriteria</li>
                            <li>w<sub>j</sub> = Nilai bobot dari setiap kriteria</li>
                            <li>V<sub>i</sub> = Nilai preferensi untuk setiap alternatif</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-award me-2"></i>Kesimpulan</h5>
                    </div>
                    <div class="card-body">
                        @if(isset($ranking[0]))
                        <p class="mb-0">
                            Berdasarkan perhitungan metode SAW dengan mempertimbangkan emisi CO₂, konsumsi bahan bakar, 
                            efisiensi, dan ukuran mesin, kendaraan <strong>{{ $ranking[0]['merk'] }} {{ $ranking[0]['model'] }}</strong> 
                            mendapatkan peringkat tertinggi dengan nilai preferensi <strong>{{ $ranking[0]['nilai_preferensi'] }}</strong> 
                            dan menjadi kendaraan paling ramah lingkungan yang direkomendasikan.
                        </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection