@extends('pasien.layouts.main')

@section('title', 'Dashboard Pasien')

@section('content')

@php
use Carbon\Carbon;

$user = Auth::user();
$pasien = $user->pasien;
$today = Carbon::today();
@endphp

<style>
.card-dashboard {
    background: #ffffff;
    padding: 16px 18px !important;
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    transition: 0.25s;
}

.card-dashboard:hover {
    transform: translateY(-4px);
}

.card-header-row {
    display: flex;
    align-items: center !important;
    gap: 10px;
    margin-bottom: 4px !important;
}

.card-header-row i{
    padding-top: 4px;
}

.card-header-row h5 { 
    margin: 0; 
    padding: 0;
    font-weight: 600;
    font-size: 16px;
}

.card-desc { 
    margin-top: 4px !important; 
    font-size: 14px; 
    color: #333; 
}

.icon-blue { color: #0288a7; }
.icon-orange { color: #f57c00; }
.icon-red { color: #c62828; }
</style>

<style>
.btnLengkapi {
    background: #bce0d1;
    color: white;
    padding: 8px 14px;
    border-radius: 8px;
    text-decoration: none;
    transition: 0.2s;
}
.btnLengkapi:hover {
    background: #a6d6c4;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translate(-50%, -48%); }
    to { opacity: 1; transform: translate(-50%, -50%); }
}
</style>

<div class="dashboard-header" style="margin-bottom: 24px; padding: 22px; background: #bce0d1; border-radius: 18px; color: white; box-shadow: 0 6px 15px rgba(0,0,0,0.08);">
    <div style="display: flex; align-items: center;">
        <h4 style="margin: 0; font-weight: 600;">Hai,</h4>

        <span style="padding: 8px; font-size: 1.5rem; color: white;">
            {{ Str::before($user->username, ' ') }}
        </span>

        <span style="font-size: 1.5rem;">👋</span>

    </div>

    <p style="margin-top: 10px; font-size: 15px; line-height: 1.5;">
        Selamat datang di <strong>Dentago</strong>.  
        Yuk, cek jadwal pemeriksaan gigimu atau buat reservasi baru supaya senyummu tetap sehat dan menawan!
    </p>
</div>

<div class="card-container" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 18px;">

    <div class="card-dashboard">
        <div class="card-header-row">
            <i class="bi bi-clipboard2-pulse fs-2 icon-blue"></i>
            <h5>Pemeriksaan Terakhir</h5>
        </div>

        @if($pemeriksaanTerakhir)
        <p class="card-desc" style="line-height: 1.55;">
            <strong style="font-size: 15px; color:#333;">
                {{ $pemeriksaanTerakhir->diagnosa }}
            </strong><br>

            <span style="color:#5a5a5a;">
                {{ Carbon::parse($pemeriksaanTerakhir->tanggal_pemeriksaan)->locale('id')->translatedFormat('l, d F Y') }}
            </span><br>

            <span style="display:block; margin-top:6px; font-weight:600; color:#2e7d32;">
                Status: {{ $pemeriksaanTerakhir->status ?? 'Selesai' }}
            </span>
        </p>
        @else
        <p class="card-desc">Belum ada pemeriksaan.</p>
        @endif
    </div>

    <div class="card-dashboard">
        <div class="card-header-row">
            <i class="bi bi-calendar-event fs-2 icon-orange"></i>
            <h5>Reservasi Berikutnya</h5>
        </div>

        @if($reservasiAktif)
            @php
                $tglRes = Carbon::parse($reservasiAktif->tanggal_reservasi);
                $hariCountdown = $today->diffInDays($tglRes, false);
            @endphp

            <p class="card-desc" style="line-height: 1.55;">
                <strong style="font-size: 15px; color:#333;">
                    {{ $tglRes->locale('id')->translatedFormat('l, d F Y') }}
                </strong><br>

                <span style="color:#5a5a5a;">
                    pukul {{ Carbon::parse($reservasiAktif->jam)->format('H:i') }} WIB
                </span><br>

                @if($hariCountdown === 0)
                    <span style="display:block; margin-top:6px; font-weight:600; color:#f57c00;">
                        Hari ini
                    </span>
                @elseif($hariCountdown > 0)
                    <span style="display:block; margin-top:6px; font-weight:600; color:#f57c00;">
                        {{ $hariCountdown }} hari lagi
                    </span>
                @else
                    <span style="display:block; margin-top:6px; font-weight:600; color:#c62828;">
                        {{ abs($hariCountdown) }} hari yang lalu
                    </span>
                @endif
            </p>
        @else
            <p class="card-desc">Belum ada reservasi aktif.</p>
        @endif
    </div>

    <div class="card-dashboard">
        <div class="card-header-row">
            <i class="bi bi-bar-chart fs-2 icon-red"></i>
            <h5>Total Reservasi</h5>
        </div>

        <div style="text-align:center; margin-top: 8px; display:flex; flex-direction:column;  align-items:center;">
            <span style="font-size: 34px; font-weight: 800; color:#c62828; line-height:1; display:inline-block; margin-top: -6px; ">
                {{ $totalReservasi }}
            </span>

            <div style="font-size: 15px; margin-top: 6px; color:#444; font-weight: 600;">
                reservasi tercatat
            </div>
        </div>
    </div>

</div>

@if(!$pasien || !$pasien->nama_pasien || !$pasien->alamat)
<div id="notifOverlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.35); backdrop-filter: blur(2px); z-index: 1500;"></div>
<div id="profilNotif" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 24px 32px; border-radius: 16px; box-shadow: 0 6px 22px rgba(0,0,0,0.2); z-index: 2000; width: 360px; text-align: center; animation: fadeIn 0.3s ease;">
    <p style="font-size: 15px; margin-bottom: 18px;">
       Ayo lengkapi profilmu supaya proses reservasi lebih cepat dan mudah.
    </p>

    <div style="display: flex; gap: 10px; justify-content: center;">
        <a href="{{ route('pasien.editprofil') }}" class="btnLengkapi">Lengkapi Profil</a>
        <button onclick="closeNotif()" class="btn btn-outline-secondary">Tutup</button>
    </div>
</div>

<script>
function closeNotif() {
    document.getElementById('profilNotif').style.display = 'none';
    document.getElementById('notifOverlay').style.display = 'none';
}
</script>
@endif

@endsection
