@extends('dokter.layouts.dashboard')

@section('content-dokter')
<div class="container mt-4">

    <h2 class="fw-bold mb-4 text-dark">Detail Pasien</h2>

    <style>
        .img-pasien {
            border-color: #cfe8df !important;
        }

        .pastel-card {
            background-color: #fff;
        }

        .btn-add-pemeriksaan {
            background-color: #bce0d1 !important;
            color: #1c3f32 !important;
            border: none;
        }

        .btn-add-pemeriksaan:hover {
            background-color: #a9d6c4 !important;
            color: #0e241d !important;
        }

        .btn-detail-pastel {
            background-color: #9ad7b3 !important;
            color: #0d3b29 !important;
            border: none;
        }

        .btn-detail-pastel:hover {
            background-color: #8ccca7 !important;
        }

        .pastel-header {
            background-color: #bce0d1 !important;
            color: #2c3e50 !important;
            font-weight: 600;
        }

        .pastel-thead {
            background-color: #dff1ea !important;
        }

        .table-hover tbody tr:hover {
            background-color: #f3faf7 !important;
        }

        .card-body-table {
            padding: 18px !important;
            padding-top: 12px !important;
        }
    </style>

    <div class="card shadow-sm border-0 rounded-4 mb-4 pastel-card">
        <div class="card-body p-4 d-flex align-items-center justify-content-between flex-wrap">

            <div class="d-flex align-items-center mb-3 mb-md-0">
                <img src="{{ asset('storage/pasien/' . $pasien->foto_pasien) }}"
                    alt="Foto Pasien"
                    class="rounded-circle border img-pasien me-4"
                    width="100" height="100">

                <div>
                    <h4 class="mb-1 fw-semibold text-dark">{{ $pasien->nama_pasien }}</h4>

                    <p class="mb-1 text-muted small">
                        <i class="bi bi-gender-ambiguous me-1"></i> {{ $pasien->jenis_kelamin }}
                        <span class="mx-2">|</span>
                        <i class="bi bi-calendar-date me-1"></i> {{ $pasien->tanggal_lahir }}
                    </p>

                    <p class="mb-1 text-muted small">
                        <i class="bi bi-telephone me-1"></i> {{ $pasien->no_telepon }}
                    </p>

                    <p class="mb-0 text-muted small">
                        <i class="bi bi-geo-alt me-1"></i> {{ $pasien->alamat }}
                    </p>
                </div>
            </div>

            <div>
                <a href="{{ route('dokter.pemeriksaan.create', $pasien->id) }}"
                    class="btn btn-add-pemeriksaan px-4 py-2 rounded-pill shadow-sm">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Pemeriksaan
                </a>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header pastel-header">
            <i class="bi bi-clipboard-data me-2"></i> Riwayat Pemeriksaan
        </div>

        <div class="card-body card-body-table">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="pastel-thead">
                        <tr>
                            <th class="text-center" width="5%">ID</th>
                            <th>Foto</th>
                            <th>Tanggal</th>
                            <th>Keluhan</th>
                            <th>Diagnosa</th>
                            <th>Tindakan</th>
                            <th>Resep Obat</th>
                            <th class="text-center" width="15%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($pasien->pemeriksaan as $pemeriksaan)
                        <tr>
                            <td class="text-center">{{ $pemeriksaan->id }}</td>

                            <td>
                                @if ($pemeriksaan->foto_kondisi_gigi)
                                <img src="{{ asset('storage/foto_gigi/' . $pemeriksaan->foto_kondisi_gigi) }}"
                                    width="50" class="rounded img-pasien">
                                @else
                                <span class="text-muted small">Tidak ada foto</span>
                                @endif
                            </td>

                            <td>{{ $pemeriksaan->tanggal_pemeriksaan }}</td>
                            <td>{{ $pemeriksaan->keluhan }}</td>
                            <td>{{ $pemeriksaan->diagnosa }}</td>
                            <td>{{ $pemeriksaan->tindakan }}</td>

                            <td>
                                @php $resep = json_decode($pemeriksaan->resep, true); @endphp
                                @if($resep)
                                <ul class="mb-0 small">
                                    @foreach ($resep as $item)
                                    <li>{{ $item['nama'] }} ({{ $item['dosis'] }})</li>
                                    @endforeach
                                </ul>
                                @else
                                <span class="text-muted small">Tidak ada resep</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <a href="{{ route('dokter.pemeriksaan.edit', $pemeriksaan->id) }}" class="btn btn-sm btn-detail-pastel">
                                    Edit
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

@endsection