@extends('pasien.layouts.main')

@section('title', 'Dashboard Pasien')

@section('content')
<h4>Hai, <span style="color: #4BC590;">Kamaya!</span></h4>
<p>Selamat datang di <strong>Dentago</strong> 🦷<br>
Yuk, cek jadwal pemeriksaan gigimu atau lakukan reservasi baru agar senyum mu tetap sehat dan menawan!</p>

<div class="card-container">
<div class="card-dashboard">
	<i class="bi bi-clipboard2-pulse"></i>
	<h5>Pemeriksaan Terakhir</h5>
	<p>belum ada pemeriksaan.</p>
</div>

<div class="card-dashboard">
	<i class="bi bi-calendar-event"></i>
	<h5>Reservasi Berikutnya</h5>
	<p>Belum ada reservasi aktif.</p>
</div>

<div class="card-dashboard">
	<i class="bi bi-bar-chart"></i>
	<h5>Total Reservasi</h5>
	<p>0 reservasi tercatat.</p>
</div>
@endsection