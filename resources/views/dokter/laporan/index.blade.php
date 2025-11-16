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

            @php
            $pemeriksaans = [
            [
            'id' => 1,
            'pasien' => ['nama_pasien' => 'Ahmad Fauzi'],
            'tanggal_pemeriksaan' => '10-12-2025',
            'diagnosa' => 'Karies gigi tingkat awal',
            'tindakan' => 'Pembersihan karang gigi dan tambal ringan'
            ],
            [
            'id' => 2,
            'pasien' => ['nama_pasien' => 'Siti Rahmawati'],
            'tanggal_pemeriksaan' => '10-12-2025',
            'diagnosa' => 'Infeksi gusi ringan',
            'tindakan' => 'Scaling dan pemberian antibiotik'
            ],
            [
            'id' => 3,
            'pasien' => ['nama_pasien' => 'Budi Santoso'],
            'tanggal_pemeriksaan' => '10-12-2025',
            'diagnosa' => 'Gigi berlubang parah',
            'tindakan' => 'Pencabutan gigi molar kanan atas'
            ],
            ];
            @endphp

            <table class="table table-hover align-middle">
                <thead class="text-center">
                    <tr>
                        <th>ID</th>
                        <th>Nama Pasien</th>
                        <th>Tanggal Pemeriksaan</th>
                        <th>Diagnosa</th>
                        <th>Tindakan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody class="text-center">
                    @foreach($pemeriksaans as $p)
                    <tr>
                        <td>{{ $p['id'] }}</td>
                        <td>{{ $p['pasien']['nama_pasien'] }}</td>
                        <td>{{ $p['tanggal_pemeriksaan'] }}</td>
                        <td>{{ $p['diagnosa'] }}</td>
                        <td>{{ $p['tindakan'] }}</td>
                        <td>
                            <a href="{{ route('dokter.laporan.export') }}" class="btn btn-sm btn-detail-pastel">
                                Export
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection