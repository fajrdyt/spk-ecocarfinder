@extends('layouts.app')

@section('title', 'Data Kendaraan - EcoCarFinder')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-car me-2"></i>Data Kendaraan</h2>
        <a href="{{ route('kendaraan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Kendaraan
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th width="3%">No</th>
                            <th>Merk</th>
                            <th>Model</th>
                            <th>Mesin (L)</th>
                            <th>Silinder</th>
                            <th>Konsumsi (L/100km)</th>
                            <th>Efisiensi (mpg)</th>
                            <th>CO₂ (g/km)</th>
                            <th width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kendaraan as $index => $k)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $k->merk }}</strong></td>
                            <td>{{ $k->model }}</td>
                            <td>{{ $k->engine_size }}</td>
                            <td>{{ $k->cylinders }}</td>
                            <td>{{ $k->fuel_consumption_comb }}</td>
                            <td>{{ $k->fuel_consumption_mpg }}</td>
                            <td>
                                <span class="badge {{ $k->co2_emissions < 150 ? 'bg-success' : ($k->co2_emissions < 250 ? 'bg-warning' : 'bg-danger') }}">
                                    {{ $k->co2_emissions }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('kendaraan.edit', $k->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('kendaraan.destroy', $k->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">Tidak ada data kendaraan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($kendaraan->count() > 0)
    <div class="card mt-3">
        <div class="card-header bg-info text-white">
            <h6 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Statistik</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <p class="mb-1 text-muted small">Total Kendaraan</p>
                    <h4>{{ $kendaraan->count() }}</h4>
                </div>
                <div class="col-md-3">
                    <p class="mb-1 text-muted small">Rata-rata CO₂</p>
                    <h4>{{ number_format($kendaraan->avg('co2_emissions'), 1) }} g/km</h4>
                </div>
                <div class="col-md-3">
                    <p class="mb-1 text-muted small">CO₂ Terendah</p>
                    <h4 class="text-success">{{ $kendaraan->min('co2_emissions') }} g/km</h4>
                </div>
                <div class="col-md-3">
                    <p class="mb-1 text-muted small">CO₂ Tertinggi</p>
                    <h4 class="text-danger">{{ $kendaraan->max('co2_emissions') }} g/km</h4>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection