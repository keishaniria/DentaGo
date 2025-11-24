@extends('pasien.layouts.main')

@section('title', 'Edit Profil')

@section('content')
<style>
    :root {
        --bs-primary: #bce0d1 !important;
        --bs-primary-rgb: 188, 224, 209 !important;
    }

    .text-primary {
        color: var(--bs-primary) !important;
    }

    .border-primary {
        border-color: var(--bs-primary) !important;
    }

    .btn-primary {
        background-color: var(--bs-primary) !important;
        border-color: var(--bs-primary) !important;
        color: #fff !important; 
        font-weight: 600;
    }

    .btn-primary:hover {
        background-color: #a7cdbc !important;
        border-color: #a7cdbc !important;
        color: #fff !important;
    }
	
    .text-primary i,
    h5.text-primary i {
        color: var(--bs-primary) !important;
    }
</style>

<div class="container-fluid">
	<div class="card shadow-sm border-0 rounded-4 p-4 mx-auto" style="max-width: 850px;">
		<h5 class="fw-bold text-primary mb-4">
			<i class="bi bi-pencil-square me-2"></i>Edit Profil
		</h5>

		<form action="{{ route('pasien.updateprofil') }}" method="POST" enctype="multipart/form-data">
			@csrf 
			@method('PUT')
			<div class="row">
				<div class="col-md-4 text-center">
					<img id="preview" src="{{ optional($pasien)->foto_pasien ? asset('storage/' . $pasien->foto_pasien) : '' }}" class="rounded-4 shadow-sm mb-4" style="width:170px; height:170px; object-fit:cover;">
					<input type="file" name="foto_pasien" class="form-control mt-2">
					<small id="foto-error" style="color: red; font-size: 13px;"></small>
				</div>

				<div class="col-md-8">
					<div class="mb-3">
						<label class="form-label">Nama</label>
						<input type="text" id="nama_pasien" name="nama_pasien" class="form-control" value="{{ optional($pasien)->nama_pasien }}">
					</div>

					<div class="mb-3">
						<label class="form-label">Tanggal Lahir</label>
						<input type="date" id="tanggal_reservasi" name="tanggal_lahir" class="form-control" value="{{ optional($pasien)->tanggal_lahir }}">
					</div>

					<div class="mb-3">
						<label class="form-label">Jenis Kelamin</label>
						<select id="jenis_kelamin" name="jenis_kelamin" class="form-select">
							<option value="Perempuan" {{ optional($pasien)->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
							<option value="Laki-Laki" {{ optional($pasien)->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
						</select>
					</div>

					<div class="mb-3">
						<label class="form-label">Alamat</label>
						<textarea class="form-control" id="alamat" name="alamat" rows="3">{{ optional($pasien)->alamat }}</textarea>
					</div>

					<div class="mb-3">
						<label class="form-label">Email</label>
						<input type="email" class="form-control" value="{{ $user->email }}" readonly>
					</div>

					<div class="mb-3">
						<label class="form-label">Nomor Telepon</label>
						<input type="text" id="no_telepon" name="no_telepon" class="form-control" value="{{ optional($pasien)->no_telepon }}">
					</div>
					
					<div class="d-flex justify-content-between mt-4">
						<a class="btn btn-outline-secondary rounded-pill px-4" href="{{ route('pasien.profilesaya') }}">
							<i class="bi bi-arrow-left me-1"></i>Kembali
                        </a>

						<button type="submit" class="btn btn-primary rounded-pill px-4">
							Simpan Perubahan
						</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div> 

<script>
document.querySelector('input[name="foto_pasien"]').addEventListener('input', function(e){
    const file = this.files[0];
    const errorText = document.getElementById('foto-error');

    errorText.textContent = '';

    if (file) {
        const ext = file.name.split('.').pop().toLowerCase();
        const maxSize = 2 * 1024 * 1024;

        if (!['jpg', 'jpeg', 'png'].includes(ext)) {
            errorText.textContent = 'File harus berupa jpg, jpeg, atau png!';
            this.value = '';
            return;
        }

        if (file.size > maxSize) {
            errorText.textContent = 'Ukuran foto maksimal 2 MB!';
            this.value = '';
            return;
        }

        errorText.textContent = '';
    }
});
</script>
@endsection