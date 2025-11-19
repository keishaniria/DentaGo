@extends('pasien.layouts.main')

@section('title', 'Detail Pemeriksaan')

@section('content')
<style>
    .text-new-green {
        color: #bce0d1 !important;
    }

    .icon-new-green {
        color: #bce0d1 !important;
    }
</style>


<div class="container-fluid">
	<div style="opacity: 1; transition: 0.3s ease;">
		<div class="card shadow-sm border-0 rounded-4 p-4 mx-auto" style="background-coloe: #fff; max-width: 700px;">
			<h5 class="fw-bold text-new-green mb-4">
				<i class="bi bi-info-circle me-2 icon-new-green"></i>Detail Pemeriksaan
			</h5>

			<div class="mb-3">
				<label class="fw-semibold text-secondary">Tanggal Pemeriksaan</label>
				<p class="text-dark mb-2">12-11-2025</p>
			</div>

			<div class="mb-3">
				<label class="fw-semibold text-secondary">Keluhan</label>
				<p class="text-dark mb-2">Sakit gigi kiri</p>
			</div>

			<div class="mb-3">
				<label class="fw-semibold text-secondary">Diagnosa</label>
				<p class="text-dark mb-2">Karies Sedang</p>
			</div>

			<div class="mb-3">
				<label class="fw-semibold text-secondary">Tindakan</label>
				<p class="text-dark mb-2">Penambalan komposit</p>
			</div>

			<div class="mb-3">
				<label class="fw-semibold text-secondary">Obat</label>
				<p class="text-dark mb-2">Ibuprofen 400mg</p>
			</div>

			<div class="text-center mt-4">
				<button onclick="backToTable()" class="btn btn-outline-secondary rounded-pill px-4">
					<i class="bi bi-arrow-left me-1"></i>Kembali ke Riwayat
				</button>
			</div>
		</div>
	</div>
</div>
@endsection