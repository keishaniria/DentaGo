@extends('pasien.layouts.main')

@section('title', 'Jadwal Pemeriksaan')

@section('content')
<div class="container-fluid">
	<div id="jadwalSection">
		<h4 class="mb-1">
			<i class="bi bi-calendar-check text-success me-2"></i>Jadwal Pemeriksaan Gigi
		</h4>
		<p class="text-muted mb-4">Berikut daftar jadwal pemeriksaan gigimu yang telah dipesan.</p>

		<div class="card shadow-sm border-0 rounded-4 p-4 mx-auto" style="background-color: #fff; max-width: 950px;">
			<div class="table-responsive">
				<table class="table align-middle text-center">
					<thead style="background-color: #f4f6f9; color: #243447; font-weight: 600;">
						<tr>
							<th>Nama</th>
							<th>Tanggal Reservasi</th>
							<th>Jam</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody class="table-group-divider">
						<tr>
							<td>Kamaya Nadeleine</td>
							<td>20-11-2025</td>
							<td>10:00</td>
							<td>
								<span class="badge bg-warning text-dark rounded-pill px-3 py-2">Menunggu</span>
							</td>
							<td>
								<button class="btn btn-outline-success btn-sm rounded-pill px-3" onclick="showDetail()">
									<i class="bi bi-eye me-1"></i>Detail
								</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	<div id="detailSection" style="display: none; opacity: 0; transition: opacity: 0.3s ease;">
		<div class="card shadow-sm border-0 rounded-4 p-4 mx-auto" style="background-color: #fff; max-width: 700px;">
			<h5 class="fw-bold text-success mb-4">
				<i class="bi bi-info-circle me-2"></i>Detail Reservasi
			</h5>

			<div class="mb-3">
				<label class="fw-semibold text-secondary">Nama</label>
			    <p class="text-dark mb-2">Kamaya Nadeleine</p>
			</div>

			<div class="mb-3">
				<label class="fw-semibold text-secondary">Tanggal Reservasi</label>
			    <p class="text-dark mb-2">20-11-2025</p>
			</div>

			<div class="mb-3">
				<label class="fw-semibold text-secondary">Jam</label>
			    <p class="text-dark mb-2">10:00</p>
			</div>

			<div class="mb-3">
				<label class="fw-semibold text-secondary">Alamat</label>
			    <p class="text-dark mb-2">Jl. Bintara No.12, Bekasi</p>
			</div>

			<div class="mb-3">
				<label class="fw-semibold text-secondary">Nomor Telepon</label>
			    <p class="text-dark mb-2">08123456789</p>
			</div>

			<div class="mb-3">
				<label class="fw-semibold text-secondary">Status</label>
			    <p class="text-dark mb-2">Menunggu</p>
			</div>

			<div class="text-center mt-4">
				<button class="btn btn-outline-secondary rounded-pill px-4" onclick="backToTable()">
					<i class="bi bi-arrow-left me-1"></i>Kembali ke Jadwal
				</button>
			</div>
		</div>
	</div>
</div>

<style>
	.table tbody tr:hover {
		background-color: #f9fbfc;
		transition: 0.2s ease;
	}
	.table th, .table td {
		vertical-align: middle;
		padding: 14px 16px;
	}
</style>

<script>
	function showDetail() {
		const table = document.getElementById('jadwalSection');
		const detail = document.getElementById('detailSection');
		table.style.display = 'none';
		detail.style.display = 'block';
		setTimeout(() => detail.style.opacity = 1, 50);
	}

	function backToTable() {
		const table = document.getElementById('jadwalSection');
		const detail = document.getElementById('detailSection');
		detail.style.opacity = 0;
		setTimeout(() => {
			detail.style.display = 'none';
			table.style.display = 'block';
		}, 300);
	}
</script>
@endsection