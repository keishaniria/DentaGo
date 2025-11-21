@extends('dokter.layouts.dashboard')

@section('content-dokter')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="fw-bold mb-0">
        <i class="bi bi-file-earmark-text me-2"></i> Laporan Pemeriksaan
    </h2>

    <a href="{{ route('dokter.laporan.export') }}" class="btn btn-pastel-blue btn-sm shadow-sm">
        <i class="bi bi-download me-1"></i> Download Laporan
    </a>
</div>

<style>
    .card-header {
        background-color: #bce0d1 !important;
        color: #2c3e50 !important;
        font-weight: 600;
    }

    .table thead {
        background-color: #bce0d1 !important;
    }

    .table-hover tbody tr:hover {
        background-color: #f3f8f6 !important;
    }

    .btn-pastel-blue {
        background-color: #a7c7e7 !important;
        color: #0d2b4d !important;
        border: none;
        padding: 6px 14px;
        font-weight: 600;
        border-radius: 6px;
        transition: 0.2s;
    }

    .btn-pastel-blue:hover {
        background-color: #96b9df !important;
        color: #0a1f36 !important;
        transform: translateY(-1px);
    }
</style>

<div class="card shadow-sm border-0">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Laporan Pemeriksaan</span>

    </div>

    <div class="card-body p-4">

        <table class="table table-hover align-middle">
            <thead class="text-center">
                <tr>
                    <th>ID</th>
                    <th>Nama Pasien</th>
                    <th>Tanggal Pemeriksaan</th>
                    <th>Keluhan</th>
                    <th>Diagnosa</th>
                    <th>Tindakan</th>
                    <th>Resep Obat</th>
                </tr>
            </thead>

            <tbody class="text-center">
                @forelse($pemeriksaans as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->pasien->nama_pasien }}</td>
                    <td>{{ $p->tanggal_pemeriksaan }}</td>
                    <td>{{ $p->keluhan }}</td>
                    <td>{{ $p->diagnosa }}</td>
                    <td>{{ $p->tindakan }}</td>
                    <td>
                        @php
                        $resep = is_string($p->resep) ? json_decode($p->resep, true) : $p->resep;
                        @endphp

                        @if(is_array($resep))
                        @foreach($resep as $r)
                        • {{ $r['nama'] }} ({{ $r['dosis'] }}) <br>
                        @endforeach
                        @else
                        {{ $p->resep }}
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">Tidak ada data pemeriksaan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>
</div>
@endsection