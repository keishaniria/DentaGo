@extends('pasien.layouts.main')

@section('title', 'Detail Reservasi')

<style>
	.text-new-green {
		color: #bce0d1 !important;
	}

	.icon-new-green {
		color: #bce0d1 !important;
	}

	.badge-menunggu {
		background-color: #ffe9a7 !important;
		color: #5a4c17 !important;
		padding: 6px 14px;
		border-radius: 20px;
		font-weight: 600;
	}

	.badge-proses {
		background-color: #a6e3f5 !important;
		color: #0b3c4a !important;
		padding: 6px 14px;
		border-radius: 20px;
		font-weight: 600;
	}

	.badge-selesai {
		background-color: #9ad7b3 !important;
		color: #0d3b29 !important;
		padding: 6px 14px;
		border-radius: 20px;
		font-weight: 600;
	}

	.badge-batal {
		background-color: #f8c6c6 !important;
		color: #7a1f1f !important;
		padding: 6px 14px;
		border-radius: 20px;
		font-weight: 600;
	}
</style>

@section('content')
<div class="container-fluid">
	<div style="opacity: 1; transition: opacity 0.3s ease;">
		<div class="card shadow-sm border-0 rounded-4 p-4 mx-auto" style="background-color: #fff; max-width: 700px;">

			<h5 class="fw-bold text-new-green mb-4">
				<i class="bi bi-info-circle me-2 icon-new-green"></i>Detail Reservasi
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
			    <p class="mb-2">
			    	<span class="badge 
			    		@if($reservasi->status == 'Menunggu') badge-menunggu
						@elseif($reservasi->status == 'Proses') badge-proses
						@elseif($reservasi->status == 'Selesai') badge-selesai
						@elseif($reservasi->status == 'Batal') badge-batal
						@endif
			    	">{{ $reservasi->status }}</span>
			    </p>
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
