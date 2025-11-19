@extends('admin.layout.dashboard')

@section('title', 'Dashboard admin')

@section('content')
<div class="content">
		<h4>Dashboard Overview</h4>

		<div class="card-container">
			<div class="card-dashboard">
				<i class="bi bi-person-badge"></i>
				<h5>Data Dokter</h5>
				<p><strong>12</strong> Terdaftar</p>
			</div>

			<div class="card-dashboard">
				<i class="bi bi-people"></i>
				<h5>Data Pasien</h5>
				<p><strong>48</strong> Aktif</p>
			</div>

			<div class="card-dashboard">
				<i class="bi bi-calendar-check"></i>
				<h5>Janji Temu</h5>
				<p><strong>5</strong> Hari Ini</p>
			</div>

			<div class="card-dashboard">
				<i class="bi bi-bar-chart"></i>
				<h5>Statistik</h5>
				<p><strong>80%</strong> Produktivitas</p>
			</div>
		</div>
</div>
