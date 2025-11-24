@extends('admin.layout.dashboard')

@section('title', 'Data dokter')

@section('content-admin')

<h2 class="fw-bold mb-3">
    <i class="bi bi-person-fill"></i> Data Dokter
    <a href="{{ route('admin.dokter.tambah-dokter') }}">Tambah data</a>
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

    table td{
        vertical-align: middle !important;
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

    .row-action {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .btn-detail {
        background: #c7eed8;
    }

    .btn-edit {
        background: #f7eaa0;
    }

    .btn-delete {
        background: #f3c2c2;
    }

    .row-action a {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        transition: 0.2s;
    }

    .row-action a:hover {
        transform: scale(1.08);
    }

    .row-action a i {
        font-size: 16px;
        color: #333;
    }

</style>

<div class="card shadow-sm border-0">
    <div class="card-header">
        Daftar Dokter
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
                            {{-- {{ dd($d->foto) }} --}}

                            <img src="{{ asset('storage/' . $d->foto) }}" 
                                 alt="Foto" width="58" height="50"
                                class="rounded-circle img-pasien">
                        </td>
                        <td>{{ $d['nama_dokter'] }}</td>
                        <td>{{ $d['no_telp'] }}</td>
                        <td class="row-action">
                            <a href="{{ route('admin.dokter.detail', $d->id) }}" class="btn-detail" title="Detail"><i class="bi bi-eye-fill"></i></a>
                            <a href="{{ route('admin.dokter.edit', $d->id) }}" class="btn-edit" title="Edit"><i class="bi bi-pencil-fill" ></i></a>
                            <a href="{{ route('admin.dokter.delete', $d->id) }}" class="btn-delete" title="Hapus"><i class="bi bi-eraser-fill" ></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function(e){
        e.preventDefault();

        let url = this.getAttribute('href'); // ⬅ ambil URL asli dari route

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