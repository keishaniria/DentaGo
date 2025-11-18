@extends('pasien.layouts.main')

@section('title', 'Profile Saya')

@section('content')
<div class="container-fluid">
	<div class="mx-auto" style="max-width: 900px;">
		<h4 class="mb-3">Profil Saya</h4>

		<div class="card shadow-sm border-0 rounded-0 overflow-hidden">
			<div style="background: #f4f6f9; padding: 14px 22px; display: flex; justify-content: space-between; align-items: center;">
				<h6 class="fw-bold mb-0 text-primary">Informasi Akun</h6>

				<a class="btn btn-primary btn-sm rounded-pill px-3 d-flex align-items-center gap-1" href="{{ route('pasien.editprofil') }}">
					<i class="bi bi-pencil-square"></i>Edit Profil
                </a>
			</div>

			<div class="card-body">
				<div class="row">
					<div class="col-md-4 text-center">
						<img src="https://via.placeholder.com/170" class="rounded-4 shadow-sm mb-3" style="width: 170px; height: 170px; object-fit: cover;" alt="Foto Profil">
					</div>

					<div class="col-md-8">

						<div class="mb-3">
							<label class="text-secondary small fw-semibold">Nama</label>
							<div class="fw-medium fs-6 text-dark">Kamaya Nadeleine</div>
						</div>

						<div class="mb-3">
							<label class="text-secondary small fw-semibold">Tanggal Lahir</label>
							<div class="fw-medium fs-6 text-dark">21-04-2007</div>
						</div>

						<div class="mb-3">
							<label class="text-secondary small fw-semibold">Jenis Kelamin</label>
							<div class="fw-medium fs-6 text-dark">Perempuan</div>
						</div>

						<div class="mb-3">
							<label class="text-secondary small fw-semibold">Alamat</label>
							<div class="fw-medium fs-6 text-dark">Jl. Bintara No.12, Bekasi</div>
						</div>

                        <div class="mb-3">
							<label class="text-secondary small fw-semibold">Email</label>
							<div class="fw-medium fs-6 text-dark">kamayanadeleine@gmail.com</div>
						</div>

						<div class="mb-3">
							<label class="text-secondary small fw-semibold">Nomor Telepon</label>
							<div class="fw-medium fs-6 text-dark">+62 812-3456-7890</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<hr class="my-4">

	<div class="text-center mt-4">
		<button class="btn btn-danger rounded-pill px-4 py-2" onclick="confirmDeleter()">
			<span class="fw-semibold text-white">Hapus Akun</span>
		</button>
	</div>
</div>
@endsection