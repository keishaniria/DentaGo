@extends('pasien.layouts.main')

@section('title', 'Buat Reservasi')

@section('content')

@php
$profilLengkap = $pasien->alamat && $pasien->no_telepon;
@endphp

<style>
    .alert-custom {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        font-size: 14px;
        padding: 12px 16px;
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .btn-alert-action {
        background-color: #f28b9a;
        color: white;
        padding: 6px 14px;
        font-size: 13px;
        border-radius: 50px;
        font-weight: 600;
        border: none;
        transition: 0.2s ease;
    }

    .btn-alert-action:hover {
        background-color: #e76c7a;
    }

    .btn-reservasi {
        background: #bce0d1;
        color: white;
        border: none;
        padding: 10px 26px;
        border-radius: 50px;
        font-weight: 600;
        transition: 0.2s ease;
    }

    .btn-reservasi:hover {
        background: #a9cfbf;
        color: white;
    }

    .icon-reservasi {
        color: #bce0d1;
    }
</style>

<div class="d-flex justify-content-center align-items-center" style="min-height: 65vh; padding-top: 0;">
    <div class="bg-white p-5 rounded-4 shadow-sm" style="width: 100%; max-width: 900px;">
        <h4 class="fw-bold text-dark mb-4 text-center">
            <i class="bi bi-clipboard-plus me-2 icon-reservasi"></i>Form Reservasi
        </h4>

        @if(!$profilLengkap)
        <div class="alert-custom" role="alert">
            <div>Silahkan lengkapi profil terlebih dahulu sebelum melakukan reservasi.</div>
            <a href="{{ route('pasien.editprofil') }}" class="btn btn-sm btn-alert-action">Lengkapi Profil</a>
        </div>
        @endif

        <form action="{{ route('pasien.reservasi.store') }}" method="POST">
            @csrf

            <input type="hidden" id="id_dokter" name="id_dokter">

            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Nama</label>
                <input type="text" class="form-control" value="{{ $pasien->nama_pasien }}" readonly>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Tanggal</label>
                    <select id="tanggal_reservasi" name="tanggal_reservasi" class="form-control" {{ $profilLengkap ? '' : 'disabled' }} required>
                        <option value="">Pilih Tanggal Dulu</option>

                        @foreach($jadwalDokter as $jd)
                        <option value="{{ $jd->tanggal }}"
                            data-dokter="{{ $jd->id_dokter }}"
                            data-mulai="{{ $jd->jam_mulai }}"
                            data-selesai="{{ $jd->jam_selesai }}">
                            {{ $jd->tanggal }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Jam</label>
                    <select id="jam" name="jam" class="form-control" {{ $profilLengkap ? '' : 'disabled' }} required>
                        <option value="">Pilih Jam</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Alamat</label>
                <textarea class="form-control" rows="3" readonly>{{ $pasien->alamat }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Nomor Telepon</label>
                <input type="text" class="form-control" value="{{ $pasien->no_telepon }}" readonly>
            </div>

            <div class="text-center">
                <button type="submit" class="btn-reservasi shadow-sm" {{ $profilLengkap ? '' : 'disabled' }}>
                    Simpan Reservasi
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('tanggal_reservasi').addEventListener('change', function() {
    let option = this.options[this.selectedIndex];

    let dokter = option.getAttribute('data-dokter');
    document.getElementById('id_dokter').value = dokter;

    let mulai = option.getAttribute('data-mulai');
    let selesai = option.getAttribute('data-selesai');
    let jamSelect = document.getElementById('jam');

    jamSelect.innerHTML = '';

    if (!mulai || !selesai) {
        jamSelect.innerHTML = '<option value="">Tidak tersedia</option>';
        return;
    }

    let start = parseInt(mulai.split(':')[0]);
    let end = parseInt(selesai.split(':')[0]);

    for (let i = start; i <= end; i++) {
        let hour = (i < 10 ? '0' + i : i) + ':00';
        let opt = document.createElement('option');
        opt.value = hour;
        opt.textContent = hour;
        jamSelect.appendChild(opt);
    }
});
</script>

@endsection
