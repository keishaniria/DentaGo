@extends('dokter.layouts.dashboard')

@section('content-dokter')

<style>
    body {
        background-color: #f5f7fa !important;
    }

    .card-header {
        background-color: #bce0d1 !important; 
        color: #2c3e50 !important;
        font-weight: 600;
    }
    
    .stat-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
        gap: 20px;
        margin: 25px 0;
    }

    .stat-card {
        border-radius: 20px;
        padding: 25px 20px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        text-align: center;
        transition: .2s ease;
    }

    .stat-card:nth-child(1) {
        background-color: #CDEDE3 !important; 
    }

    .stat-card:nth-child(2) {
        background-color: #F7DDE2 !important; 
    }

    .stat-card:nth-child(3) {
        background-color: #D9EAFB !important; 
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.11);
    }

    .stat-card h3 {
        font-size: 38px;
        font-weight: 700;
        margin: 0;
        color: #0f3a2b;
    }

    .stat-card p {
        margin: 8px 0 0;
        color: #1e4d3b;
        font-weight: 500;
        font-size: 15px;
    }

    .table-custom thead tr {
        background-color: #bce0d1 !important;
    }

    .table-custom tbody tr:hover {
        background-color: #e9f6ef !important;
        transition: .2s;
    }

    .card-soft {
        border: none;
        border-radius: 18px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.07);
    }

    .card-header-soft {
        background: #ffffff;
        border-bottom: none;
        font-weight: 600;
        padding: 18px 22px;
        border-radius: 18px 18px 0 0;
        font-size: 17px;
    }

    .badge-soft-green {
        background-color: #a4d6b9;
        color: #0f3a2b;
        padding: 6px 14px;
        border-radius: 15px;
        font-weight: 600;
    }

    .badge-soft-yellow {
        background-color: #f3e5a0;
        color: #7a6a00;
        padding: 6px 14px;
        border-radius: 15px;
        font-weight: 600;
    }

    .badge-soft-blue {
        background-color: #d0e8ff;
        color: #0b4c86;
        padding: 6px 14px;
        border-radius: 15px;
        font-weight: 600;
    }
</style>



<h2 class="fw-bold mb-3">
    <i class="bi bi-clipboard2-pulse me-2"></i> Dashboard Dokter
</h2>

<div class="stat-container">
    <div class="stat-card">
        <h3>12</h3>
        <p>Pasien Hari Ini</p>
    </div>

    <div class="stat-card">
        <h3>5</h3>
        <p>Jadwal Pemeriksaan</p>
    </div>

    <div class="stat-card">
        <h3>3</h3>
        <p>Reservasi Menunggu</p>
    </div>
</div>

<div class="card card-soft mt-4">
    <div class="card-header">
        Jadwal Pemeriksaan Hari Ini
    </div>

    <div class="card-body p-4">
        <table class="table table-hover align-middle table-custom">
            <thead>
                <tr>
                    <th>Nama Pasien</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Jenis Pemeriksaan</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Rian Pratama</td>
                    <td></td>
                    <td></td>
                    <td>Pemeriksaan Gigi Berlubang</td>
                    <td><span class="badge-soft-green">Selesai</span></td>
                </tr>

                <tr>
                    <td>Siti Nurhaliza</td>
                    <td></td>
                    <td></td>
                    <td>Tambal Gigi</td>
                    <td><span class="badge-soft-yellow">Menunggu</span></td>
                </tr>

                <tr>
                    <td>Keisha Aniria</td>
                    <td></td>
                    <td></td>
                    <td>Pembersihan Karang Gigi</td>
                    <td><span class="badge-soft-blue">Proses</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
