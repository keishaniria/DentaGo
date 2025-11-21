@extends('admin.layout.dashboard')

@section('title', 'Data pasien')

@section('content')

<h2 class="fw-bold mb-3">
    <i class="bi bi-person-fill"></i> Data Dokter
</h2>


<style>
    .card-header {
        background-color: #bce0d1 !important; 
        color: #2c3e50 !important;
        font-weight: 600;
    }

    .table thead {
        background-color: #bce0d1 !important;
    }

    .table-hover tbody tr:hover {
        background-color: #f3f8f6 !important;
    }

    .btn-detail-pastel {
        background-color: #9ad7b3 !important;
        color: #0d3b29 !important;
        border: none;
    }
    .btn-detail-pastel:hover {
        background-color: #8ccca7 !important;
    }

    .img-pasien {
        border: 2px solid #d9ebe4;
        padding: 2px;
    }
</style>

<div class="card shadow-sm border-0">
    <div class="card-header">
        Daftar Pasien
    </div>
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="text-center">
                <tr>
                    <th>No.</th>
                    <th>Foto</th>
                    <th>Nama Dokter</th>
                    <th>No. Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dokter as $d)
                    <tr class="text-center">
                        <td>{{ $d['id'] }}</td>
                        <td>
                            <img src="{{ asset('storage/dokter/' . $d->foto) }}" 
                                 alt="Foto" width="150"
                                 class=" img-pasien">
                        </td>
                        <td>{{ $d['nama_dokter'] }}</td>
                        <td>{{ $d['no_telp'] }}</td>
                        <td>
                            {{-- <a href="{{ route('admin.dokter.show', $d['id']) }}" 
                               class="btn btn-sm btn-detail-pastel">
                                Detail
                            </a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection