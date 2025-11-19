@extends('pasien.layouts.main')

@section('title', 'Dashboard Pasien')

@section('content')

@php 
    $user = Auth::user();
    $pasien = $user->pasien;
@endphp

<h4>Hai, <span style="color: #bce0d1;">{{ Str::before($user->username, ' ') }}!</span></h4>
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
</div>

@if(!$pasien || !$pasien->nama_pasien || !$pasien->alamat)
<div id="notifOverlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.35); backdrop-filter: blur(2px); z-index: 1500;"></div>
<div id="profilNotif" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 24px 32px; border-radius: 16px; box-shadow: 0 6px 22px rgba(0,0,0,0.2); z-index: 2000; width: 360px; text-align: center; animation: fadeIn 0.3s ease;">
    <p style="font-size: 15px; margin-bottom: 18px;">
        Ayo lengkapi profil mu! supaya reservasi jauh lebih mudah
    </p>

    <div style="display: flex; gap: 10px; justify-content: center;">
        <a href="{{ route('pasien.editprofil') }}" class="btnLengkapi">
            Lengkapi Profil
        </a>
        <button onclick="closeNotif()" class="btn btn-outline-secondary">
            Tutup
        </button>
    </div>
</div>

<style>
.btnLengkapi {
    background: #bce0d1;
    color: white;
    border: none;
    padding: 8px 14px;
    border-radius: 8px;
    text-decoration: none;
    transition: 0.2s ease;
}

.btnLengkapi:hover {
    background: #a6d6c4;
    color: white;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translate(-50%, -48%); }
    to   { opacity: 1; transform: translate(-50%, -50%); }
}
</style>

<script>
function closeNotif() {
    document.getElementById('profilNotif').style.display = 'none';
    document.getElementById('notifOverlay').style.display = 'none';
}
</script>
@endif

@if(!$pasien || !$pasien->nama_pasien || !$pasien->alamat)
<script>
document.addEventListener("DOMContentLoaded", function() {
    const toastEl = document.getElementById('profilToast');
    const toast = new bootstrap.Toast(toastEl, { delay: 6000 });
    toast.show();
});
</script>
@endif

@endsection
