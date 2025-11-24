@extends('admin.layout.dashboard')

@section('title', 'Riwayat Pemeriksaan')

@section('content-admin')

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

    table td {
        vertical-align: middle !important;
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

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="fw-bold mb-3">
        <i class="bi bi-book-half"></i> Riwayat Pemeriksaan
    </h2>

    <a href="{{ route('dokter.laporan.export') }}" class="btn btn-pastel-blue btn-sm shadow-sm">
        <i class="bi bi-download me-1"></i> Download Laporan
    </a>
</div>
<div class="card shadow-sm border-0">
    <div class="card-header">
        Data Pemeriksaan
    </div>


    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="text-center">
                <tr>
                    <th>No.</th>
                    <th>Tanggal Pemeriksaan</th>
                    <th>Nama Pasien</th>
                    <th>Nama Dokter</th>
                    <th>Keluhan</th>
                    <th>Diagnosa</th>
                    <th>Tindakan</th>
                    <th>Resep</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($riwayat as $r)
                <tr class="text-center">
                    <td>{{ $r->id }}</td>
                    <td>{{ $r->tanggal_pemeriksaan }}</td>
                    <td>{{ $r->pasien->nama_pasien ?? '-' }}</td>
                    {{-- <td>{{ $r->dokter->nama_dokter ?? '-' }}</td> --}}
                    <td>{{ $r->dokter->nama_dokter ?? '-' }}</td>
                    <td>{{ $r->keluhan }}</td>
                    <td>{{ $r->diagnosa }}</td>
                    <td>{{ $r->tindakan }}</td>
                    <td>
                        @php
                        $resep = $r->resep;
                        if (!is_array($resep)) {
                            $decoded = json_decode($resep, true);
                            if (json_last_error() === JSON_ERROR_NONE) {
                                $resep = $decoded;
                            }
                        }

                        if (is_array($resep)) {
                            $resepText = collect($resep)->map(fn($r) => "{$r['nama']} ({$r['dosis']})")->implode(", ");
                        } else {
                            $resepText = "-";
                        }
                    @endphp
                    {{ $resepText }}
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

@endsection
