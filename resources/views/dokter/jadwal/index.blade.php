@extends('dokter.layouts.dashboard')

@section('content-dokter')
<h2 class="fw-bold mb-3">
    <i class="bi bi-calendar-check me-2"></i> Jadwal Pemeriksaan
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

    .badge-menunggu {
        background-color: #ffe9a7 !important;
        color: #5a4c17 !important;
    }

    .badge-proses {
        background-color: #a6e3f5 !important;
        color: #0b3c4a !important;
    }

    .badge-selesai {
        background-color: #9ad7b3 !important;
        color: #0d3b29 !important;
    }

    .btn-danger-soft {
        background-color: #f8c6c6 !important;
        color: #7a1f1f !important;
        border: none;
    }

    .btn-danger-soft:hover {
        background-color: #f5b2b2 !important;
    }
</style>

<div class="card shadow-sm border-0">
    <div class="card-header">
        Daftar Jadwal Pemeriksaan
    </div>
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead>
                <tr class="text-center">
                    <th>Nama Pasien</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Jenis Pemeriksaan</th>
                    <th>Status</th>
                    <th style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwal as $j)
                <tr class="text-center">
                    <td>{{ $j->nama_pasien }}</td>
                    <td>{{ $j->tanggal }}</td>
                    <td>{{ $j->jam }}</td>
                    <td>{{ $j->jenis_pemeriksaan }}</td>

                    <td>
                        @if ($j->status == 'Menunggu')
                        <span class="badge badge-menunggu">Menunggu</span>
                        @elseif ($j->status == 'Proses')
                        <span class="badge badge-proses">Proses</span>
                        @elseif ($j->status == 'Selesai')
                        <span class="badge badge-selesai">Selesai</span>
                        @endif
                    </td>

                    <td class="text-center">
                        @if ($j->status === 'Selesai')
                        <form action="{{ route('dokter.jadwal.destroy', $j->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger-soft">Hapus</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

@endsection