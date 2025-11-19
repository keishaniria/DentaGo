@extends('dokter.layouts.dashboard')

@section('content-dokter')
<div class="container-fluid px-4">
    <h2 class="fw-bold mb-3">
        <i class="bi bi-file-earmark-text me-2"></i> Laporan Pemeriksaan
    </h2>

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

        .btn-detail-pastel {
            background-color: #9ad7b3 !important;
            color: #0d3b29 !important;
            border: none;
        }

        .btn-detail-pastel:hover {
            background-color: #8ccca7 !important;
        }
    </style>

    <div class="card shadow-sm border-0">
        <div class="card-header">
            Laporan Pemeriksaan
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
                        <th>Aksi</th>
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
                            // decode JSON string menjadi array
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

                        <td>
                            <a href="{{ route('dokter.laporan.export', $p->id) }}" class="btn btn-sm btn-detail-pastel">
                                Export
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">Tidak ada data pemeriksaan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection