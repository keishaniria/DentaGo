@extends('admin.layout.dashboard')

@section('title', 'Edit Profil')

@section('content-admin')
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

		<form action="{{ route('admin.dokter.update', $dokter->id) }}" method="POST" enctype="multipart/form-data">
			@csrf 
			@method('PUT')
			<div class="row">
				<div class="col-md-4 text-center">
					{{-- {{ dd($dokter->foto) }} --}}
					<img id="preview" @if($dokter->foto) src="{{ asset('storage/'.$dokter->foto) }}" @endif class="rounded-4 shadow-sm mb-4" style="width:170px; height:170px; object-fit:cover;">
					<input type="file" name="foto" class="form-control mt-2">
					<small id="foto-error" style="color: red; font-size: 13px;"></small>
				</div>

				<div class="col-md-8">
					<div class="mb-3">
						<label class="form-label">Nama</label>
						<input type="text" id="nama_dokter" name="nama_dokter" class="form-control" value="{{ $dokter->nama_dokter }}">
					</div>

					<div class="mb-3">
						<label class="form-label">Email</label>
						<input type="email" class="form-control" value="{{ $dokter->user->email }}" readonly>
					</div>

					<div class="mb-3">
						<label class="form-label">Nomor Telepon</label>
						<input type="text" id="no_telp" name="no_telp" class="form-control" value="{{ $dokter->no_telp }}">
					</div>
					
					<div class="d-flex justify-content-between mt-4">
						<a class="btn btn-outline-secondary rounded-pill px-4" href="{{ route('admin.dokter.index') }}">
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
	document.querySelector('input[name="foto"]').addEventListener('input', function(e){
    const file = this.files[0];
    const errorText = document.getElementById('foto-error');


	if(file){
		const ext = file.name.split('.').pop().toLowerCase();
		if(!['jpg', 'jpeg', 'png'].includes(ext)){
			errorText.textContent = 'File harus berupa jpg, jpeg, atau png!';
			this.value = '';
		}else{
			errorText.textContent = '';
		}
	}else{
		errorText.textContent = '';
	}
});
</script>
@endsection