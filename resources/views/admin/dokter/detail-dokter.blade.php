@extends('admin.layout.dashboard')

@section('title', 'Detail Dokter')

@section('content-admin')

<style>
    :root {
        --bs-primary: #2c3e50 !important;
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
        background-color: #d9534f !important;
        border-color:  #d9534f !important;
        color: #fff !important;
        font-weight: 600;
    }

    .btn-danger:hover {
        background-color: #c64541 !important;
        border-color: #c64541 !important;
    }

    .text-danger { 
        color: #d9534f !important;
    }

    .border-danger {
        border-color: #d9534f !important;
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

	    @if(session('success'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				{{ session('success') }}
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		@endif

		<h4 class="mb-3">Detail dokter</h4>

		<div class="card shadow-sm border-0 rounded-0 overflow-hidden">
			<div style="background: #bce0d1; padding: 14px 22px; display: flex; justify-content: space-between; align-items: center;">
				<h6 class="fw-bold mb-0 text-primary">Informasi Drg. {{ $dokter->nama_dokter }}</h6>
                
			</div>

			<div class="card-body">
				<div class="row">
					<div class="col-md-4 text-center">
						<img src="{{ $dokter->foto ? asset('storage/' . $dokter->foto) : 'https://via.placeholder.com/170'}}" 
                             class="rounded-4 shadow-sm mb-3" 
                             style="width: 170px; height: 170px; object-fit: cover;" 
                             alt="Foto Profil">
					</div>

					<div class="col-md-8">

						<div class="mb-3">
							<label class="text-secondary small fw-semibold">Nama</label>
							<div class="fw-medium fs-6 text-dark">{{ $dokter->user->username }}</div>
						</div>

						<div class="mb-3">
							<label class="text-secondary small fw-semibold">Nama lengkap</label>
							<div class="fw-medium fs-6 text-dark">{{ $dokter->nama_dokter }}</div>
						</div>

                        <div class="mb-3">
							<label class="text-secondary small fw-semibold">Email</label>
							<div class="fw-medium fs-6 text-dark">{{ $dokter->user->email }}</div>
						</div>

						<div class="mb-3">
							<label class="text-secondary small fw-semibold">Nomor Telepon</label>
							<div class="fw-medium fs-6 text-dark">{{ $dokter->no_telp ?? '-'}}</div>
						</div>

						<div class="mb-3">
							<label class="text-secondary small fw-semibold">Dibuat pada</label>
							<div class="fw-medium fs-6 text-dark">{{ $dokter->created_at}}</div>
						</div>

                        <div class="d-flex justify-content-between mt-4">
						<a class="btn btn-outline-secondary rounded-pill px-4" href="{{ route('admin.dokter.index') }}">
							<i class="bi bi-arrow-left me-1"></i>Kembali
                        </a>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
@endsection
