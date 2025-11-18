@extends('pasien.layouts.main')

@section('title', 'Edit Profil')

@section('content')
<div class="container-fluid">
	<div class="card shadow-sm border-0 rounded-4 p-4 mx-auto" style="max-width: 850px;">
		<h5 class="fw-bold text-primary mb-4">
			<i class="bi bi-pencil-square me-2"></i>Edit Profil
		</h5>

		<form action="#" method="POST" encytype="multipart/form-data">
			@csrf 
			<div class="row">
				<div class="col-md-4 text-center">
					<img src="https://via.placeholder.com/170" class="rounded-4 shadow-sm mb-4" style="width:170px; height:170px; object-fit:cover;">
					<input type="file" class="form-control mt-2">
				</div>

				<div class="col-md-8">
					<div class="mb-3">
						<label class="form-label">Nama</label>
						<input type="text" class="form-control" value="Kamaya Nadeleine">
					</div>

					<div class="mb-3">
						<label class="form-label">Tanggal Lahir</label>
						<input type="date" class="form-control" value="2007-04-21">
					</div>

					<div class="mb-3">
						<label class="form-label">Jenis Kelamin</label>
						<select class="form-select">
							<option selected>Perempuan</option>
							<option>Laki-Laki</option>
						</select>
					</div>

					<div class="mb-3">
						<label class="form-label">Alamat</label>
						<textarea class="form-control" rows="3">Jl. Bintara No.12, Bekasi</textarea>
					</div>


					<div class="mb-3">
						<label class="form-label">Email</label>
						<input type="email" class="form-control" value="kamayanadeleine@gmail.com">
					</div>

					<div class="mb-3">
						<label class="form-label">Nomor Telepon</label>
						<input type="text" class="form-control" value="+62 812-3456-7890">
					</div>
					
					<div class="d-flex justify-content-between mt-4">
						<a type="button" class="btn btn-outline-secondary rounded-pill px-4" href="{{ route('pasien.profilesaya') }}">
							<i class="bi bi-arrow-left me-1"></i>Kembali
                        </a>

						<button class="btn btn-primary rounded-pill px-4">
							Simpan Perubahan
						</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div> 
@endsection