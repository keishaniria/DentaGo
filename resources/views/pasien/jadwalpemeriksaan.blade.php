@extends('pasien.layouts.main')

@section('title', 'Jadwal Pemeriksaan')

@section('content')

<style>
	.icon-jadwal {
		color: #bce0d1 !important;
	}

	.btn-outline-new {
		border: 1.5px solid #bce0d1;
		color: #bce0d1;
		background: transparent;
		transition: 0.2s ease;
	}

	.btn-outline-new:hover {
		background: #bce0d1;
		color: white;
	}

	/* === SOFT BADGE COLORS === */
	.badge-menunggu {
		background-color: #ffe9a7 !important;
		color: #5a4c17 !important;
	}

	.badge-proses {
		background-color: #a6e3f5 !important;
		color: #0b3c4a !important;
	}

	.badge-selesai {
		background-color: #9ad7b3 !important;
		color: #0d3b29 !important;
	}

	.badge-batal {
		background-color: #f8c6c6 !important;
		color: #7a1f1f !important;
	}

	.table tbody tr:hover {
		background-color: #f9fbfc;
		transition: 0.2s ease;
	}
</style>


<div class="container-fluid">
	@if(session('success'))
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			{{ session('success') }}
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	@endif

	<h4 class="mb-1">
		<i class="bi bi-calendar-check icon-jadwal me-2"></i>Jadwal Pemeriksaan Gigi
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
					@forelse($reservasi as $r)
					<tr>
						<td>{{ $r->pasien->nama_pasien }}</td>

						<td>{{ \Carbon\Carbon::parse($r->tanggal_reservasi)->format('d-m-Y') }}</td>

						<td>{{ \Carbon\Carbon::parse($r->jam)->format('H:i') }}</td>

						<td>
							<span class="badge rounded-pill px-3 py-2 
								@if($r->status == 'Menunggu') badge-menunggu
								@elseif($r->status == 'Proses') badge-proses
								@elseif($r->status == 'Selesai') badge-selesai
								@elseif($r->status == 'Batal') badge-batal
								@endif
							">{{ $r->status }}</span>
						</td>

						<td>
							<a href="{{ route('pasien.jadwalpemeriksaan.show', $r->id) }}" 
							   class="btn btn-outline-new btn-sm rounded-pill px-3">
								<i class="bi bi-eye me-1"></i>Detail
							</a>
						</td>
					</tr>
					@empty
					   <tr>
						   <td colspan="5" class="text-center text-muted py-4">
							    Tidak ada reservasi yang dilakukan.
						   </td>
					   </tr>
					@endforelse
				</tbody>

			</table>
		</div>
	</div>
</div>

@endsection
