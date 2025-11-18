@extends('pasien.layouts.main')

@section('title', 'Riwayat Pemeriksaan')

@section('content')
<div class="container-fluid">
	<h4 class="mb-1">
		<i class="bi bi-clock-history text-success me-2"></i>Riwayat Pemeriksaan
	</h4>
	<p class="text-muted mb-4">Berikut daftar riwayat pemeriksaan gigi yang pernah kamu lakukan.</p>

	<div class="card shadow-sm border-0 rounded-4 p-4 mx-auto" style="background-color: #fff; max-width: 950px;">
		<div class="table-responsive">
			<table class="table align-middle text-center">
				<thead style="background-color: #f4f6f9; color: #243447; font-weight: 600;">
					<th>Tanggal</th>
					<th>Keluhan</th>
					<th>Diagnosa</th>
					<th>Tindakan</th>
					<th>Aksi</th>
				</thead>

				<tbody class="table-group-divider">
					<tr>
						<td>12-11-2025</td>
						<td>Sakit gigi kiri</td>
						<td>Karies Sedang</td>
						<td>Penambalan</td>
						<td>
							<button class="btn btn-outline-success btn-sm rounded-pill px-3" onclick="showDetail()">
								<i class="bi bi-eye me-1"></i>Detail
							</button>
						</td>
					</tr>
					<tr>
						<td>02-10-2025</td>
						<td>Gusi berdarah</td>
						<td>Gingivitis Ringin</td>
						<td>Scaling</td>
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
@endsection