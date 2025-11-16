@extends('dokter.layouts.dashboard')

@section('content-dokter')
<div class="container-fluid px-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">
            <i class="bi bi-clipboard-plus me-2"></i> Edit Pemeriksaan
        </h2>
        <h5 class="text-muted">
            Pasien: <span class="fw-semibold">{{ $pemeriksaan->pasien->nama_pasien ?? 'Pasien Dummy' }}</span>
        </h5>
    </div>

    <style>
        .pastel-card {
            background-color: #fff;
        }

        .pastel-header {
            background-color: #bce0d1 !important;
            color: #2c3e50 !important;
        }

        .pastel-label {
            color: #355e54;
        }

        .pastel-btn {
            background-color: #a7dbc7;
            color: #17573e;
            border: none;
            transition: 0.2s;
        }

        .pastel-btn:hover {
            background-color: #97d1ba;
        }

        .pastel-outline-success {
            border: 1px solid #8ecfba;
            color: #3f7a66;
        }

        .pastel-outline-success:hover {
            background-color: #bce0d1;
            color: white;
        }

        .pastel-outline-secondary {
            border: 1px solid #ccc;
            color: #555;
        }

        .pastel-outline-secondary:hover {
            background-color: #ececec;
        }

        .pastel-danger {
            background-color: #ffdddd;
            border: 1px solid #ffbcbc;
            color: #c0392b;
        }

        .pastel-danger:hover {
            background-color: #ffc9c9;
            color: #a0261c;
        }
    </style>

    <div class="card shadow-sm border-0 pastel-card rounded-4">
        <div class="card-header pastel-header fw-semibold">
            <i class="bi bi-file-earmark-medical me-2"></i> Form Pemeriksaan
        </div>

        <div class="card-body p-4">
            <form action="{{ route('dokter.pemeriksaan.update', $pemeriksaan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label pastel-label fw-semibold">Keluhan</label>
                    <textarea class="form-control pastel-input" name="keluhan" rows="2" required>{{ old('keluhan', $pemeriksaan->keluhan) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label pastel-label fw-semibold">Diagnosa</label>
                    <textarea class="form-control pastel-input" name="diagnosa" rows="2" required>{{ old('diagnosa', $pemeriksaan->diagnosa) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label pastel-label fw-semibold">Tindakan</label>
                    <textarea class="form-control pastel-input" name="tindakan" rows="2" required>{{ old('tindakan', $pemeriksaan->tindakan) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label pastel-label fw-semibold">Resep Obat</label>
                    <div id="resep-container">
                        @foreach ($pemeriksaan->resep as $item)
                        <div class="resep-item pastel-border rounded p-3 mb-2">
                            <input type="text" name="nama_obat[]" class="form-control pastel-input mb-2" placeholder="Nama Obat" value="{{ $item->nama ?? $item['nama'] }}" required>
                            <input type="text" name="dosis[]" class="form-control pastel-input mb-2" placeholder="Dosis" value="{{ $item->dosis ?? $item['dosis'] }}" required>
                            <button type="button" class="btn pastel-danger btn-sm w-100 remove-obat">
                                <i class="bi bi-trash me-1"></i> Hapus
                            </button>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" id="tambah-obat" class="btn pastel-outline-success btn-sm mt-2">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Obat
                    </button>
                </div>

                <div class="mb-3">
                    <label class="form-label pastel-label fw-semibold">Tanggal Pemeriksaan</label>
                    <input type="date" name="tanggal_pemeriksaan" class="form-control pastel-input" required
                        value="{{ old('tanggal_pemeriksaan', $pemeriksaan->tanggal_pemeriksaan instanceof \Carbon\Carbon ? $pemeriksaan->tanggal_pemeriksaan->format('Y-m-d') : $pemeriksaan->tanggal_pemeriksaan) }}">
                </div>

                <div class="mb-4">
                    <label class="form-label pastel-label fw-semibold">Foto Kondisi Gigi</label>
                    <input type="file" name="foto_kondisi_gigi" class="form-control pastel-input">
                    @if ($pemeriksaan->foto_kondisi_gigi)
                    <img src="{{ asset('storage/foto_gigi/' . $pemeriksaan->foto_kondisi_gigi) }}" width="100" class="mt-2">
                    @endif
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('dokter.pasien.show', $pemeriksaan->id_pasien ?? 1) }}" class="btn pastel-outline-secondary me-2 px-4">
                        <i class="bi bi-arrow-left-circle me-1"></i> Batal
                    </a>
                    <button type="submit" class="btn pastel-btn px-4">
                        <i class="bi bi-save2 me-1"></i> Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('resep-container');
        const addBtn = document.getElementById('tambah-obat');

        addBtn.addEventListener('click', function() {
            const newItem = document.createElement('div');
            newItem.classList.add('resep-item', 'pastel-border', 'rounded', 'p-3', 'mb-2');
            newItem.innerHTML = `
            <input type="text" name="nama_obat[]" class="form-control pastel-input mb-2" placeholder="Nama Obat" required>
            <input type="text" name="dosis[]" class="form-control pastel-input mb-2" placeholder="Dosis" required>
            <button type="button" class="btn pastel-danger btn-sm w-100 remove-obat">
                <i class="bi bi-trash me-1"></i> Hapus
            </button>
        `;
            container.appendChild(newItem);
        });

        container.addEventListener('click', function(e) {
            if (e.target.closest('.remove-obat')) {
                e.target.closest('.resep-item').remove();
            }
        });
    });
</script>
@endsection