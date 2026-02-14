@extends('layouts.app')

@section('title', 'Data Kriteria - EcoCarFinder')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-list-check me-2"></i>Data Kriteria</h2>
        <a href="{{ route('kriteria.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Kriteria
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Kode</th>
                            <th>Nama Kriteria</th>
                            <th width="15%">Bobot (%)</th>
                            <th width="15%">Jenis</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kriteria as $index => $k)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><span class="badge bg-primary">{{ $k->kode_kriteria }}</span></td>
                            <td>{{ $k->nama_kriteria }}</td>
                            <td>
                                <div class="progress" style="height: 25px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $k->bobot }}%">
                                        {{ $k->bobot }}%
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($k->jenis == 'benefit')
                                    <span class="badge bg-success">Benefit</span>
                                @else
                                    <span class="badge bg-warning">Cost</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('kriteria.edit', $k->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('kriteria.destroy', $k->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                            <td colspan="6" class="text-center">Tidak ada data kriteria</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($kriteria->count() > 0)
    <div class="card mt-3">
        <div class="card-header bg-info text-white">
            <h6 class="mb-0"><i class="fas fa-calculator me-2"></i>Total Bobot</h6>
        </div>
        <div class="card-body">
            @php
                $totalBobot = $kriteria->sum('bobot');
            @endphp
            <h3 class="mb-0">
                {{ $totalBobot }}%
                @if($totalBobot == 100)
                    <span class="badge bg-success ms-2">Valid</span>
                @else
                    <span class="badge bg-danger ms-2">Bobot harus 100%</span>
                @endif
            </h3>
        </div>
    </div>
    @endif
</div>
@endsection