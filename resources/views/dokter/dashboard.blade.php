@extends('dokter.layouts.dashboard')

@section('content-dokter')

<style>
    body {
        background-color: #f5f7fa !important;
    }

    .greeting {
        font-size: 22px;
        font-weight: 600;
        color: #244c42;
        margin-bottom: 4px;
    }

    .greeting span {
        font-weight: 800;
        color: #0f3a2b;
    }

    .sub-greeting {
        font-size: 15px;
        color: #4f6f62;
        margin-bottom: 25px;
        margin-top: -4px;
    }

    .stat-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 22px;
        margin: 25px 0;
    }

    .stat-card {
        display: flex;
        align-items: center;
        gap: 20px;
        border-radius: 22px;
        padding: 24px 22px;
        box-shadow: 0 6px 14px rgba(0,0,0,0.10);
        transition: 0.2s ease;
        height: 140px;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 20px rgba(0,0,0,0.14);
    }

    .stat-icon {
        font-size: 48px;
        opacity: 0.8;
    }

    .stat-info h3 {
        font-size: 38px;
        font-weight: 800;
        margin: 0;
        color: #0f3a2b;
    }

    .stat-info p {
        margin: 6px 0 0;
        font-weight: 600;
        font-size: 16px;
        color: #264b3d;
    }

    .card-green { background-color: #CDEDE3; }
    .card-pink  { background-color: #F7DDE2; }
    .card-blue  { background-color: #D9EAFB; }


</style>

<div class="greeting">
    Halo, <span>{{ auth()->user()->username }}</span> 
</div>

<p class="sub-greeting">
    Semoga harimu menyenangkan dalam merawat senyum para pasien. Yuk lihat apa saja yang perlu kamu periksa hari ini!
</p>

<h2 class="fw-bold mb-3">
    <i class="bi bi-clipboard2-pulse me-2"></i> Dashboard Dokter
</h2>

{{-- STAT CARDS --}}
<div class="stat-container">

    <div class="stat-card card-green">
        <i class="bi bi-people-fill stat-icon"></i>
        <div class="stat-info">
            <h3>{{ $data['pasien_hari_ini'] }}</h3>
            <p>Pasien Hari Ini</p>
        </div>
    </div>

    <div class="stat-card card-pink">
        <i class="bi bi-calendar2-check stat-icon"></i>
        <div class="stat-info">
            <h3>{{ $data['jadwal_hari_ini'] }}</h3>
            <p>Jadwal Pemeriksaan</p>
        </div>
    </div>

    <div class="stat-card card-blue">
        <i class="bi bi-person-vcard-fill stat-icon"></i>
        <div class="stat-info">
            <h3>{{ $data['total_pasien'] }}</h3>
            <p>Total Pasien Terdaftar</p>
        </div>
    </div>

</div>

@endsection
