@extends('layouts.app')

@section('title', 'Edit Kendaraan - EcoCarFinder')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2><i class="fas fa-edit me-2"></i>Edit Kendaraan</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('kendaraan.index') }}">Kendaraan</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Form Edit Kendaraan</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('kendaraan.update', $kendaraan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Merk <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('merk') is-invalid @enderror" 
                                       name="merk" value="{{ old('merk', $kendaraan->merk) }}" 
                                       placeholder="Contoh: TOYOTA" required>
                                @error('merk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Model <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('model') is-invalid @enderror" 
                                       name="model" value="{{ old('model', $kendaraan->model) }}" 
                                       placeholder="Contoh: CAMRY HYBRID" required>
                                @error('model')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ukuran Mesin (L) <span class="text-danger">*</span></label>
                                <input type="number" step="0.1" class="form-control @error('engine_size') is-invalid @enderror" 
                                       name="engine_size" value="{{ old('engine_size', $kendaraan->engine_size) }}" 
                                       placeholder="Contoh: 2.5" required>
                                @error('engine_size')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jumlah Silinder <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('cylinders') is-invalid @enderror" 
                                       name="cylinders" value="{{ old('cylinders', $kendaraan->cylinders) }}" 
                                       placeholder="Contoh: 4" required>
                                @error('cylinders')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Konsumsi BBM (L/100km) <span class="text-danger">*</span></label>
                                <input type="number" step="0.1" class="form-control @error('fuel_consumption_comb') is-invalid @enderror" 
                                       name="fuel_consumption_comb" value="{{ old('fuel_consumption_comb', $kendaraan->fuel_consumption_comb) }}" 
                                       placeholder="Contoh: 5.8" required>
                                @error('fuel_consumption_comb')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Efisiensi BBM (mpg) <span class="text-danger">*</span></label>
                                <input type="number" step="0.1" class="form-control @error('fuel_consumption_mpg') is-invalid @enderror" 
                                       name="fuel_consumption_mpg" value="{{ old('fuel_consumption_mpg', $kendaraan->fuel_consumption_mpg) }}" 
                                       placeholder="Contoh: 48" required>
                                @error('fuel_consumption_mpg')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Emisi CO₂ (g/km) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('co2_emissions') is-invalid @enderror" 
                                   name="co2_emissions" value="{{ old('co2_emissions', $kendaraan->co2_emissions) }}" 
                                   placeholder="Contoh: 135" required>
                            @error('co2_emissions')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update
                            </button>
                            <a href="{{ route('kendaraan.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection