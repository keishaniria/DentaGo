@extends('admin.layout.dashboard')

@section('title', 'Data Dokter')

@section('content-admin')


<style>
    .card-header {
        background-color: #bce0d1 !important; 
        color: #2c3e50 !important;
        font-weight: 600;
    }

    .table thead {
        background-color: #bce0d1 !important;
        color: #2c3e50 !important;
        font-weight: 600;
    }

    .table-hover tbody tr:hover {
        background-color: #f3f8f6 !important;
    }

    table td {
        vertical-align: middle !important;
    }

    .img-dokter {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #d9ebe4;
    }
    td.row-action {
        vertical-align: middle !important;
        padding: 8px 0 !important;
    }

    .row-action {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .row-action a, 
    .row-action button {
        width: 32px;
        height: 32px;
        padding: 0 !important;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
    }
    .btn-green {
        background-color: #8ee89e !important;
        color: #0d2b4d !important;
        border: none;
        padding: 6px 14px;
        font-weight: 600;
        border-radius: 6px;
        transition: 0.2s;
    }

    .btn-green:hover {
        background-color: #8ee89e !important;
        color: #0a1f36 !important;
        transform: translateY(-1px);
    }
    .row-action a i, .row-action button i {
        font-size: 16px;
        color: #333;
    }
    
    .btn-detail { background: #c7eed8; }
    .btn-detail:hover { background: #b0e1c7; }
    
    .btn-edit { background: #f7eaa0; }
    .btn-edit:hover { background: #f0e186; }
    
    .btn-delete { background: #f3c2c2; }
    .btn-delete:hover { background: #eaa8a8; }
    </style>

<h2 class="fw-bold mb-4 d-flex justify-content-between align-items-center">
    <span><i class="bi bi-person-fill me-2"></i>Data Dokter</span>
    <a href="{{ route('admin.dokter.tambah-dokter') }}" class="btn btn-green btn-sm shadow-sm">
        <i class="bi bi-person-fill-add"></i> Tambah Dokter
    </a>
</h2>

<div class="card shadow-sm border-0">
    <div class="card-header">Daftar Dokter</div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-center">
                <thead>
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
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ $d->foto ? asset('storage/' . $d->foto) : asset('images/default-doctor.png') }}" 
                                 alt="Foto Dokter" class="img-dokter">
                        </td>
                        <td>{{ $d->nama_dokter }}</td>
                        <td>{{ $d->no_telp }}</td>
                        <td class="row-action">
                            <a href="{{ route('admin.dokter.detail', $d->id) }}" class="btn-detail" title="Detail"><i class="bi bi-eye-fill"></i></a>
                            <a href="{{ route('admin.dokter.edit', $d->id) }}" class="btn-edit" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                            <a href="{{ route('admin.dokter.delete', $d->id) }}" class="btn-delete" title="Hapus"><i class="bi bi-eraser-fill"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- SWEETALERT HAPUS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function(e){
        e.preventDefault();
        let url = this.getAttribute('href');

        Swal.fire({
            title: "Hapus data?",
            text: "Data tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d9534f",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Ya, hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
});
</script>

@endsection
