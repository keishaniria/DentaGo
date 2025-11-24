@extends('dokter.layouts.dashboard')

@section('content-dokter')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="fw-bold">
        <i class="bi bi-calendar-check me-2"></i> Jadwal Pemeriksaan
    </h2>

    <button class="btn btn-tambah" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-circle me-1"></i> Tambah Jam Praktek
    </button>
</div>

<style>
    .btn-tambah,
    .btn-simpan {
        background-color: #bce0d1 !important;
        color: #2c3e50 !important;
        border: none !important;
        font-weight: 600;
    }

    .btn-tambah:hover,
    .btn-simpan:hover {
        background-color: #abd7c4 !important;
    }

    .card-header {
        background-color: #bce0d1 !important;
        color: #2c3e50 !important;
        font-weight: 600;
    }

    .table thead {
        background-color: #bce0d1 !important;
    }

    .badge-menunggu {
        background-color: #ffe9a7 !important;
        color: #5a4c17 !important;
    }

    .badge-proses {
        background-color: #a6e3f5 !important;
        color: #0b3c4a !important;
    }

    .badge-selesai {
        background-color: #9ad7b3 !important;
        color: #0d3b29 !important;
    }

    .btn-status-selesai {
        background-color: #9ad7b3 !important;
        color: #0d3b29 !important;
        border: none !important;
        padding: 5px 10px !important;
        font-size: 13px !important;
        border-radius: 6px !important;
        font-weight: 600 !important;
    }

    .btn-status-selesai:hover {
        background-color: #86c9a1 !important;
    }

    .badge-batal {
        background-color: #f8c6c6 !important;
        color: #7a1f1f !important;
    }

    .btn-danger-soft {
        background-color: #f8c6c6 !important;
        color: #7a1f1f !important;
        border: none;
    }

    .btn-danger-soft:hover {
        background-color: #f5b2b2 !important;
    }

    .alert-success {
        background-color: #d7ecff !important;
        color: #0b3954 !important;
        border-left: 5px solid #5ca9ff !important;
    }
</style>

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-header">
        Daftar Jadwal Pemeriksaan
    </div>

    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead>
                <tr class="text-center">
                    <th>Nama Pasien</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Status</th>
                    <th style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwal as $j)
                <tr class="text-center">
                    <td>{{ $j->pasien->nama_pasien ?? '-' }}</td>
                    <td>{{ $j->tanggal }}</td>
                    <td>{{ $j->jam}}</td>

                    <td class="text-center">
                        @php $status = strtolower($j->status); @endphp

                        @if ($status === 'menunggu')
                        <span class="badge badge-menunggu">Menunggu</span>
                        @elseif ($status === 'selesai')
                        <span class="badge badge-selesai">Selesai</span>
                        @elseif ($status === 'batal')
                        <span class="badge badge-batal">Batal</span>
                        @endif
                    </td>

                    <td class="text-center">
                        @php $status = strtolower($j->status); @endphp

                        @if ($status !== 'selesai')
                        <form action="{{ route('dokter.jadwal.updateStatus', $j->id) }}"
                            method="POST" style="display:inline-block;">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="selesai">
                            <button class="btn btn-sm btn-status-selesai">
                                <i></i> Ubah status selesai
                            </button>
                        </form>
                        @endif

                        @if ($status === 'selesai')
                        <form action="{{ route('dokter.jadwal.destroy', $j->id) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin hapus?')" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger-soft">
                                <i></i> Hapus
                            </button>
                        </form>
                        @endif
                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('dokter.jadwal.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Tambah Jam Praktek Dokter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="form-control" required>
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-simpan">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection