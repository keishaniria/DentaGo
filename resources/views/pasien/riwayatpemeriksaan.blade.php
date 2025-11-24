@extends('pasien.layouts.main')

@section('title', 'Riwayat Pemeriksaan')

@section('content')

<style>
	.icon-new-green {
		color: #bce0d1 !important;
	}

	.btn-outline-new {
		border: 1.5px solid #bce0d1 !important;
		color: #bce0d1 !important;
		background: transparent;
		transition: 0.2s ease;
	}

	.btn-outline-new:hover {
		background: #bce0d1 !important;
		color: white !important;
	}

	.table tbody tr:hover {
		background-color: #f9fbfc;
		transition: 0.2s ease;
	}
</style>

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

<div class="container-fluid">
	<h4 class="mb-1">
		<i class="bi bi-clock-history icon-new-green me-2"></i>Riwayat Pemeriksaan
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
					@forelse($riwayat as $rw) 
					   <tr>
							<td>{{ \Carbon\Carbon::parse($rw->tanggal_pemeriksaan)->format('d-m-Y') }}</td>
							<td>{{ $rw->keluhan }}</td>
							<td>{{ $rw->diagnosa }}</td>
							<td>{{ $rw->tindakan }}</td>
							<td>
								<a class="btn btn-outline-new btn-sm rounded-pill px-3" href="{{ route('pasien.riwayatpemeriksaan.detail', $rw->id)}}">
									<i class="bi bi-eye me-1"></i>Detail
								</a>
							</td>
						</tr>
					@empty 
					      <tr>
						   <td colspan="5" class="text-center text-muted py-4">
							    Tidak ada pemeriksaan yang dilakukan.
						   </td>
					   </tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection