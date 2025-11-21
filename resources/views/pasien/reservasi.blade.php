@extends('pasien.layouts.main')

@section('title', 'Buat Reservasi')

@section('content')

<div class="d-flex justify-content-center align-items-center" style="min-height: 65vh; padding-top: 0;">
	<div class="bg-white p-5 rounded-4 shadow-sm" style="width: 100%; max-width: 480px;">
		<h4 class="fw-bold text-dark mb-4 justify-content-center">
		    <i class="bi bi-clipboard-plus me-2 icon-reservasi"></i>Form Reservasi
	    </h4>

	<form action="{{ route('pasien.reservasi.store') }}" method="POST">
		@csrf 

		<input type="hidden" name="id_dokter" value="{{ $jadwalDokter->first()->id_dokter ?? '' }}">

		<div class="mb-3">
			<label class="form-label fw-semibold text-secondary">Nama</label>
			<input type="text" class="form-control" value="{{ $pasien->nama_pasien }}" readonly>
		</div>

		<div class="row g-3 mb-3">

			<div class="col-md-6">
				<label class="form-label fw-semibold text-secondary">Tanggal</label>
				<select id="tanggal_reservasi" name="tanggal_reservasi" class="form-control" required>
					<option value="">-- Pilih Tanggal --</option>
					@foreach($jadwalDokter as $jd)
						<option value="{{ $jd->tanggal }}"
							data-mulai="{{ $jd->jam_mulai }}"
							data-selesai="{{ $jd->jam_selesai }}">
							{{ $jd->tanggal }}
						</option>
					@endforeach
				</select>
			</div>

			<div class="col-md-6">
				<label class="form-label fw-semibold text-secondary">Jam</label>
				<select id="jam" name="jam" class="form-control" required>
					<option value="">Pilih Tanggal dulu</option>
				</select>
			</div>

		</div>

		<div class="mb-3">
			<label class="form-label fw-semibold text-secondary">Alamat</label>
			<textarea class="form-control" rows="3" readonly>{{ $pasien->alamat }}</textarea>
		</div>

		<div class="mb-3">
			<label class="form-label fw-semibold text-secondary">Nomor Telepon</label>
			<input type="text" class="form-control" value="{{ $pasien->no_telepon }}" readonly>
		</div>

		<div class="text-center">
			<button type="submit" class="btn-reservasi shadow-sm">
				Simpan Reservasi
			</button>
		</div>
	</form>
</div>

</div>


<script>
document.getElementById('tanggal_reservasi').addEventListener('change', function() {
	let option = this.options[this.selectedIndex];
	let mulai = option.getAttribute('data-mulai');
	let selesai = option.getAttribute('data-selesai');
	let jamSelect = document.getElementById('jam');

	jamSelect.innerHTML = '';
	
	if(!mulai || !selesai){
		jamSelect.innerHTML = '<option value="">Tidak tersedia</option>';
		return;
	}

	let start = parseInt(mulai.split(':')[0]);
	let end = parseInt(selesai.split(':')[0]);

	for(let i = start; i <= end; i++){
		let hour = (i < 10 ? '0' + i : i) + ':00';
		let opt = document.createElement('option');
		opt.value = hour;
		opt.textContent = hour;
		jamSelect.appendChild(opt);
	}
});
</script>

<style>
	.btn-reservasi {
		background: #bce0d1;
		color: white;
		border: none;
		padding: 10px 26px;
		border-radius: 50px;
		font-weight: 600;
		transition: 0.2s ease;
	}

	.btn-reservasi:hover {
		background: #a9cfbf; 
		color: white;
	}

	.icon-reservasi {
		color: #bce0d1;
	}
</style>

@endsection