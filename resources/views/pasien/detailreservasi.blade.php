@extends('pasien.layouts.main')

@section('title', 'Detail Reservasi')

@section('content')
<div class="container-fluid">
	<div style="dopacity: 1; transition: opacity: 0.3s ease;">
		<div class="card shadow-sm border-0 rounded-4 p-4 mx-auto" style="background-color: #fff; max-width: 700px;">
			<h5 class="fw-bold text-success mb-4">
				<i class="bi bi-info-circle me-2"></i>Detail Reservasi
			</h5>

			<div class="mb-3">
				<label class="fw-semibold text-secondary">Nama</label>
			    <p class="text-dark mb-2">{{ $reservasi->pasien->nama_pasien }}</p>
			</div>

			<div class="mb-3">
				<label class="fw-semibold text-secondary">Tanggal Reservasi</label>
			    <p class="text-dark mb-2">{{ \Carbon\Carbon::parse($reservasi->tanggal_reservasi)->format('d-m-Y') }}</p>
			</div>

			<div class="mb-3">
				<label class="fw-semibold text-secondary">Jam</label>
			    <p class="text-dark mb-2">{{ \Carbon\Carbon::parse($reservasi->jam)->format('H:i') }}</p>
			</div>

			<div class="mb-3">
				<label class="fw-semibold text-secondary">Alamat</label>
			    <p class="text-dark mb-2">{{ $reservasi->pasien->alamat }}</p>
			</div>

			<div class="mb-3">
				<label class="fw-semibold text-secondary">Nomor Telepon</label>
			    <p class="text-dark mb-2">{{ $reservasi->pasien->no_telepon }}</p>
			</div>

			<div class="mb-3">
				<label class="fw-semibold text-secondary">Status</label>
			    <p class="text-dark mb-2">{{ $reservasi->status }}</p>
			</div>

			<div class="text-center mt-4">
				<a class="btn btn-outline-secondary rounded-pill px-4" href="{{ route('pasien.jadwalpemeriksaan') }}">
					<i class="bi bi-arrow-left me-1"></i>Kembali ke Jadwal
				</a>
			</div>
		</div>
	</div>
</div>
@endsection