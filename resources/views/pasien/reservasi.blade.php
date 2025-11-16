@extends('pasien.layouts.main')

@section('title', 'Buat Reservasi')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 65vh; padding-top: 0;">
	<div class="bg-white p-5 rounded-4 shadow-sm" style="width: 100%; max-width: 480px;">
		<h4 class="fw-bold text-dark mb-4 justify-content-center">
		    <i class="bi bi-clipboard-plus me-2 text-success"></i>Form Reservasi
	    </h4>

		<form action="#" method="POST">
			@csrf 
			<div class="mb-3">
				<label for="nama" class="form-label fw-semibold text-secondary">Nama</label>
				<input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
			</div>
			<div class="row g-3 mb-3">
				<div class="col-md-6">
					<label for="tanggal_reservasi" class="form-label fw-semibold text-secondary">Tanggal Reservasi</label>
					<input type="date" class="form-control" id="tanggal_reservasi" name="tanggal_reservasi" required>
				</div>

				<div class="col-md-6">
					<label for="jam" class="form-label fw-semibold text-secondary">Jam</label>
					<input type="time" class="form-control" id="jam" name="jam" required>
				</div>
			</div>
			<div class="mb-3">
				<label for="alamat" class="form-label fw-semibold text-secondary">Alamat</label>
				<textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
			</div>
			<div class="mb-3">
				<label for="nomor_telepon" class="form-label fw-semibold text-secondary">Nomor Telepon</label>
				<input type="tel" pattern="[0-9]{10,13}" class="form-control" id="nomor_telepon" name="nomor_telepon" placeholder="08xxxxxxxxxx" required>
			</div>

			<div class="text-center">
				<button type="submit" class="btn btn-success px-4 py-2 fw-semibold shadow-sm rounded-pill">
					Simpan Reservasi
				</button>
			</div>
		</form>
	</div>
</div>
@endsection