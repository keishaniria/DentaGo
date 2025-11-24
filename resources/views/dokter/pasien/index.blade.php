@extends('dokter.layouts.dashboard')

@section('content-dokter')
<h2 class="fw-bold mb-3">
    <i class="bi bi-people-fill me-2"></i> Data Pasien
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
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Nama Pasien</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th> 
                    <th>No. Telepon</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pasien as $p)
                <tr class="text-center">
                    <td>{{ $p->id }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $p->foto_pasien) }}"
                            alt="Foto" width="50"
                            class="rounded-circle img-pasien">
                    </td>
                    <td>{{ $p->nama_pasien }}</td>
                    <td>{{ $p->jenis_kelamin }}</td>
                    <td>{{ $p->tanggal_lahir ? \Carbon\Carbon::parse($p->tanggal_lahir)->format('Y-m-d') : '-' }}</td>
                    <td>{{ $p->no_telepon }}</td>
                    <td>{{ $p->alamat }}</td>
                    <td>
                        <a href="{{ route('dokter.pasien.show', $p['id']) }}"
                            class="btn btn-sm btn-detail-pastel">
                            Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection