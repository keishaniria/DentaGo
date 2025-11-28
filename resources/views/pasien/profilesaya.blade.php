@extends('pasien.layouts.main')

@section('title', 'Profile Saya')

@section('content')

<style>
    .text-primary {
        color: #bce0d1 !important;
    }

    .bg-primary {
        background-color: #bce0d1 !important;
    }

    .border-primary {
        border-color: #bce0d1 !important;
    }

    .btn-primary {
        background-color: #bce0d1 !important;
        border-color: #bce0d1 !important;
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
						<img src="{{ optional($pasien)->foto_pasien ? asset('storage/' . $pasien->foto_pasien) : 'https://via.placeholder.com/170'}}" 
                             class="rounded-4 shadow-sm mb-3" 
                             style="width: 170px; height: 170px; object-fit: cover;" 
                             alt="Foto Profil">
					</div>

					<div class="col-md-8">

						<div class="mb-3">
							<label class="text-secondary small fw-semibold">Nama</label>
							<div class="fw-medium fs-6 text-dark">{{ $user->username }}</div>
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
		<button class="btn btn-danger rounded-pill px-4 py-2" data-bs-toggle="modal" data-bs-target="#modalHapusAkun">
			<span class="fw-semibold">Hapus Akun</span>
		</button>
	</div>
</div>

<div class="modal fade" id="modalHapusAkun" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title text-danger fw-bold">Hapus Akun</h5>
      </div>

      <div class="modal-body">
        <p class="mb-0">
          Yakin ingin menghapus akun? Semua data mu termasuk riwayat reservasi dan pemeriksaan akan ikut terhapus.
        </p>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

        <form action="{{ route('pasien.hapusakun') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger fw-semibold">
                Hapus 
            </button>
        </form>
      </div>

    </div>
  </div>
</div>
@endsection
