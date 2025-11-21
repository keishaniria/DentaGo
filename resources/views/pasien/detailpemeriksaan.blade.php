@extends('pasien.layouts.main')

@section('title', 'Detail Pemeriksaan')

@section('content')
<style>
    .text-new-green {
        color: #bce0d1 !important;
    }

    .icon-new-green {
        color: #bce0d1 !important;
    }
</style>

<div class="container-fluid">
	<div style="opacity: 1; transition: 0.3s ease;">
		<div class="card shadow-sm border-0 rounded-4 p-4 mx-auto" style="background-coloe: #fff; max-width: 700px;">
			<h5 class="fw-bold text-new-green mb-4">
				<i class="bi bi-info-circle me-2 icon-new-green"></i>Detail Pemeriksaan
			</h5>

			<div class="mb-3">
				<label class="fw-semibold text-secondary">Tanggal Pemeriksaan</label>
				<p class="text-dark mb-2">{{ \Carbon\Carbon::parse($pemeriksaan->tanggal_pemeriksaan)->format('d-m-Y') }}</p>
			</div>

			<div class="mb-3">
				<label class="fw-semibold text-secondary">Keluhan</label>
				<p class="text-dark mb-2">{{ $pemeriksaan->keluhan }}</p>
			</div>

			<div class="mb-3">
				<label class="fw-semibold text-secondary">Diagnosa</label>
				<p class="text-dark mb-2">{{ $pemeriksaan->diagnosa }}</p>
			</div>

			<div class="mb-3">
				<label class="fw-semibold text-secondary">Tindakan</label>
				<p class="text-dark mb-2">{{ $pemeriksaan->tindakan }}</p>
			</div>

			<div class="mb-3">
				<label class="fw-semibold text-secondary">Obat</label>
				@if($pemeriksaan->resep)
					@php
						$obats = json_decode($pemeriksaan->resep, true);
					@endphp
					@if(!empty($obats))
						<ul class="text-dark mb-2">
							@foreach($obats as $obat)
								@php
									$aturan = $obat['dosis'];
									$perHari = $perKali = '';
									if(str_contains($aturan, 'x')){
										[$perHari, $perKali] = explode('x', $aturan);
									}
								@endphp
								<li>
									{{ $obat['nama'] }} - {{ $obat['dosis'] }}
									@if($perHari && $perKali)
										({{ $perKali }} tablet, {{ $perHari }} kali sehari)
									@endif
								</li>
							@endforeach
						</ul>
					@else
						<p class="text-dark mb-2">Tidak ada obat.</p>
					@endif
				@else
					<p class="text-dark mb-2">Tidak ada obat.</p>
				@endif
			</div>
			
			<div class="text-center mt-4">
				<a class="btn btn-outline-secondary rounded-pill px-4" href="{{ route('pasien.riwayatpemeriksaan') }}">
					<i class="bi bi-arrow-left me-1"></i>Kembali ke Riwayat
				</a>
			</div>
		</div>
	</div>
</div>
@endsection