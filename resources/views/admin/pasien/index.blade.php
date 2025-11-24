@extends('admin.layout.dashboard')

@section('title', 'Data pasien')

@section('content-admin')

<h2 class="fw-bold mb-3">
    <i class="bi bi-person-fill"></i> Data Pasien
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

	.badge-batal {
		background-color: #f8c6c6 !important;
		color: #7a1f1f !important;
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
                    <th>Nama Pasien</th>
                    <th>Nama Dokter</th>
                    <th>No. Telp</th>
                    <th>Alamat</th>
                    <th>Tanggal Pemeriksaan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservasi as $r)
                <tr class="text-center">
                    <td>{{ $r->id }}</td>
                    <td>{{ $r->pasien->nama_pasien }}</td>
                    <td>{{ $r->dokter->nama_dokter }}</td>
                    <td>{{ $r->pasien->no_telepon }}</td>
                    <td>{{ $r->pasien->alamat }}</td>
                    <td>{{ $r->created_at->format('Y-m-d') ?? '-' }}</td>
                    <td>
                        <span class="badge rounded-pill px-3 py-2 
								@if($r->status == 'Menunggu') badge-menunggu
								@elseif($r->status == 'Proses') badge-proses
								@elseif($r->status == 'Selesai') badge-selesai
								@elseif($r->status == 'Batal') badge-batal
								@endif
							">{{ $r->status }}
                        </span>
                    </td>
                    <td>
                        @if($r->status !== 'batal' && $r->status !== 'selesai')
                            <a href="{{ route('admin.pemeriksaan.cancel', $r->id) }}"
                                class="btn btn-danger btn-sm btn-cancel"
                                data-id="{{ $r->id }}">
                                Batalkan
                            </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.querySelectorAll('.btn-cancel').forEach(btn => {
    btn.addEventListener('click', function(e){
        e.preventDefault();

        let url = this.getAttribute('href');

        Swal.fire({
            title: "Batalkan reservasi?",
            text: "Aksi ini tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d9534f",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Ya, batalkan!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
});
</script>

@endsection