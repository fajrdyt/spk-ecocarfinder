@extends('layouts.app')

@section('title', 'Edit Kriteria - EcoCarFinder')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2><i class="fas fa-edit me-2"></i>Edit Kriteria</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('kriteria.index') }}">Kriteria</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Form Edit Kriteria</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('kriteria.update', $kriteria->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label">Kode Kriteria <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('kode_kriteria') is-invalid @enderror" 
                                   name="kode_kriteria" value="{{ old('kode_kriteria', $kriteria->kode_kriteria) }}" 
                                   placeholder="Contoh: C1" required>
                            @error('kode_kriteria')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Kriteria <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_kriteria') is-invalid @enderror" 
                                   name="nama_kriteria" value="{{ old('nama_kriteria', $kriteria->nama_kriteria) }}" 
                                   placeholder="Contoh: Emisi CO2" required>
                            @error('nama_kriteria')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Bobot (%) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control @error('bobot') is-invalid @enderror" 
                                   name="bobot" value="{{ old('bobot', $kriteria->bobot) }}" 
                                   placeholder="0 - 100" min="0" max="100" required>
                            @error('bobot')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Total bobot semua kriteria harus 100%</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Kriteria <span class="text-danger">*</span></label>
                            <select class="form-select @error('jenis') is-invalid @enderror" name="jenis" required>
                                <option value="">- Pilih Jenis -</option>
                                <option value="benefit" {{ old('jenis', $kriteria->jenis) == 'benefit' ? 'selected' : '' }}>Benefit (Semakin besar semakin baik)</option>
                                <option value="cost" {{ old('jenis', $kriteria->jenis) == 'cost' ? 'selected' : '' }}>Cost (Semakin kecil semakin baik)</option>
                            </select>
                            @error('jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update
                            </button>
                            <a href="{{ route('kriteria.index') }}" class="btn btn-secondary">
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