@extends('admin.layout.dashboard')

@section('title', 'Dashboard admin')

@section('content-admin')
<style>
.dashboard-wrapper {
    display: grid;
    grid-template-columns: 1.4fr 1fr;
    gap: 30px;
    align-items: start;
    max-width: 1100px;
}

.stat-value {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 26px !important;
    font-weight: 700;
}

/* GRID CARD */
.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.dashboard-card {
	display: flex;
    flex-direction: column;
    border-radius: 12px;
    padding: 20px 22px;
	justify-content: center;
    align-items: center;
    background: #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: 0.25s;

}

.dashboard-title {
    margin-left: 5px;
    margin-bottom: 15px;
}

.content {
    margin-left: 270px !important;
    padding: 90px 40px !important;
}

.dashboard-card:hover {
    transform: translateY(-3px);
}

.chart-box {
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: 0.25s;

	display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.title-section {
    text-align: left;
    margin-bottom: 30px;
    font-size: 26px;
    font-weight: 700;
}

@media (max-width: 900px) {
    .dashboard-wrapper {
        grid-template-columns: 1fr;
    }
}
</style>
    <h2 class="mb-4 fw-bold">Dashboard Overview</h2>

<div class="dashboard-wrapper">
	<div class="dashboard-grid">
		<div class="dashboard-card">
			<h6 class="fw-bold text-secondary mb-2">Pasien Terdaftar</h6>
			<p class="stat-value"><i class="bi bi-people me-2"></i>{{ $data['total_pasien'] }} </p>
		</div>
	
		<div class="dashboard-card">
			<h6 class="fw-bold text-secondary mb-2">Dokter</h6>
			<p class="fw-bold fs-4 mb-2"><i class="bi bi-person"></i>{{ $data['total_dokter'] }}</p>
		</div>
	
		<div class="dashboard-card">
			<h6 class="fw-bold text-secondary mb-2">Total Pemeriksaan</h6>
			<p class="fw-bold fs-4 mb-2"><i class="bi bi-file-earmark-text"></i>{{ $data['total_pemeriksaan'] }}</p>
		</div>
	</div>
	
	<div class="chart-box">
		<h5 class="fw-bold mb-3">Data Status Pasien</h5>
		<canvas id="pie-chart"></canvas>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
	const statusLabels = @json(array_keys($data['status_pasien']));
    const statusData   = @json(array_values($data['status_pasien']));
	new Chart(document.getElementById("pie-chart"), {
		type: 'pie',
		data: {
		labels: ["Menunggu", "Proses", "Selesai", "Batal"],
		datasets: [{
			label: "Jumlah pasien",
			backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
			data: statusData
		}]
		},
		options: {
		title: {
			display: true,
			text: 'Data status pasien'
		}
		}
	});
</script>

@endsection
