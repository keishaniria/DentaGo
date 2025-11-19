@extends('pasien.layouts.main')

@section('title', 'Profile Saya')

@section('content')

<style>
    :root {
        --bs-primary: #bce0d1 !important;
        --bs-primary-rgb: 188, 224, 209 !important;

        --bs-danger: #f8c6c6 !important;
        --bs-danger-rgb: 248, 198, 198 !important;
    }

    .text-primary {
        color: var(--bs-primary) !important;
    }

    .bg-primary {
        background-color: var(--bs-primary) !important;
    }

    .border-primary {
        border-color: var(--bs-primary) !important;
    }

    .btn-primary {
        background-color: var(--bs-primary) !important;
        border-color: var(--bs-primary) !important;
        color: #000 !important;
        font-weight: 600;
    }

    .btn-primary:hover {
        background-color: #a7cdbc !important;
        border-color: #a7cdbc !important;
    }

    .btn-danger {
        background-color: var(--bs-danger) !important;
        border-color: var(--bs-danger) !important;
        color: #000 !important;
        font-weight: 600;
    }

    .btn-danger:hover {
        background-color: #eab5b5 !important;
        border-color: #eab5b5 !important;
    }

    .text-danger {
        color: var(--bs-danger) !important;
    }

    .border-danger {
        border-color: var(--bs-danger) !important;
    }

	.profile-content a {
		color: inherit !important;
		text-decoration: none !important;
	}

    .btn-primary,
    .btn-primary i {
        color: #ffffff !important;
    }

    .btn-danger,
    .btn-danger span,
    .btn-danger i {
        color: #ffffff !important;
    }
</style>

<div class="container-fluid">
	<div class="mx-auto" style="max-width: 900px;">
		<h4 class="mb-3">Profil Saya</h4>

		<div class="card shadow-sm border-0 rounded-0 overflow-hidden">
			<div style="background: #f4f6f9; padding: 14px 22px; display: flex; justify-content: space-between; align-items: center;">
				<h6 class="fw-bold mb-0 text-primary">Informasi Akun</h6>
                
				<div class="profile-name">
					<a class="btn btn-primary btn-sm rounded-pill px-3 d-flex align-items-center gap-1" href="{{ route('pasien.editprofil') }}">
						<i class="bi bi-pencil-square"></i>Edit Profil
					</a>
				</div>
			</div>

			<div class="card-body">
				<div class="row">
					<div class="col-md-4 text-center">
						<img src="{{ $pasien->foto_pasien ? asset('storage/' . $pasien->foto_pasien) : 'https://via.placeholder.com/170'}}" 
                             class="rounded-4 shadow-sm mb-3" 
                             style="width: 170px; height: 170px; object-fit: cover;" 
                             alt="Foto Profil">
					</div>

					<div class="col-md-8">

						<div class="mb-3">
							<label class="text-secondary small fw-semibold">Nama</label>
							<div class="fw-medium fs-6 text-dark">{{ $pasien->nama_pasien }}</div>
						</div>

						<div class="mb-3">
							<label class="text-secondary small fw-semibold">Tanggal Lahir</label>
							<div class="fw-medium fs-6 text-dark">{{ $pasien->tanggal_lahir ?? '-'}}</div>
						</div>

						<div class="mb-3">
							<label class="text-secondary small fw-semibold">Jenis Kelamin</label>
							<div class="fw-medium fs-6 text-dark">{{ $pasien->jenis_kelamin ?? '-'}}</div>
						</div>

						<div class="mb-3">
							<label class="text-secondary small fw-semibold">Alamat</label>
							<div class="fw-medium fs-6 text-dark">{{ $pasien->alamat ?? '-'}}</div>
						</div>

                        <div class="mb-3">
							<label class="text-secondary small fw-semibold">Email</label>
							<div class="fw-medium fs-6 text-dark">{{ $user->email }}</div>
						</div>

						<div class="mb-3">
							<label class="text-secondary small fw-semibold">Nomor Telepon</label>
							<div class="fw-medium fs-6 text-dark">{{ $pasien->no_telepon ?? '-'}}</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<hr class="my-4">

	<div class="text-center mt-4">
		<button class="btn btn-danger rounded-pill px-4 py-2" onclick="confirmDeleter()">
			<span class="fw-semibold">Hapus Akun</span>
		</button>
	</div>
</div>
@endsection
