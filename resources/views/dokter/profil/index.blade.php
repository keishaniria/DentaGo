@extends('dokter.layouts.dashboard')

@section('title', 'Profil Dokter')

@section('content-dokter')

<style>
    .dokter-card-header {
        background-color: #bce0d1 !important;
        padding: 16px 22px;
    }

    .dokter-card-header h6 {
        color: #2c3e50;
        font-weight: 600;
    }

    .dokter-profile-body {
        background: #f8fffc;
        padding: 25px;
    }

    .dokter-photo {
        width: 170px;
        height: 170px;
        border: 4px solid #bce0d1;
        object-fit: cover;
        border-radius: 15px;
    }

    .dokter-info-box {
        background: #edf8f3;
        border-left: 4px solid #bce0d1;
        padding: 14px 16px;
        border-radius: 10px;
        margin-bottom: 14px;
    }

    .dokter-label {
        font-size: 0.78rem;
        font-weight: 600;
        color: #6c757d;
    }

    .dokter-value {
        font-weight: 600;
        font-size: 1rem;
        color: #2c3e50;
    }
</style>

<div class="container-fluid">
    <div class="mx-auto" style="max-width: 900px;">
        <h4 class="fw-bold mb-3 d-flex align-items-center gap-2">
            <i class="bi bi-person-badge fs-4 "></i>
            Profil Dokter
        </h4>

        <div class="card shadow-sm border-0 rounded-3 overflow-hidden">

            <div class="dokter-card-header">
                <h6 class="mb-0">Informasi Akun Dokter</h6>
            </div>

            <div class="dokter-profile-body">

                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="https://via.placeholder.com/170" class="dokter-photo" alt="Foto Dokter">
                    </div>

                    <div class="col-md-8">

                        <div class="dokter-info-box">
                            <label class="dokter-label">Nama Dokter</label>
                            <div class="dokter-value">{{ $user->username }}</div>
                        </div>

                        <div class="dokter-info-box">
                            <label class="dokter-label">Nomor Telepon</label>
                            <div class="dokter-value">{{ $user->no_telp }}</div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection