@extends('pasien.layouts.main')

@section('title', 'Jadwal Pemeriksaan')

@section('content')
<div class="container-fluid">
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
					@foreach($reservasi as $r)
					<tr>
						<td>{{ $r->pasien->nama_pasien }}</td>
						<td>{{ \Carbon\Carbon::parse($r->tanggal_reservasi)->format('d-m-Y') }}</td>
						<td>{{ \Carbon\Carbon::parse($r->jam)->format('H:i') }}</td>
						<td>
							<span class="badge
							      @if($r->status == 'Menunggu') bg-warning text-dark
								  @elseif($r->status == 'Proses') bg-primary
								  @elseif($r->status == 'Selesai') bg-success
								  @elseif($r->status == 'Batal') bg-success
								  @endif 
								  rounded-pill px-3 py-2">{{ $r->status }}</span>
						</td>
						<td>
							<a href="{{ route('pasien.jadwalpemeriksaan.show', $r->id) }}" class="btn btn-outline-success btn-sm rounded-pill px-3">
								<i class="bi bi-eye me-1"></i>Detail
							</a>
						</td>
					</tr>
					@endforeach
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