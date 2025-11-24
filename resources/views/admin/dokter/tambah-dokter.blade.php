@extends('admin.layout.dashboard')

@section('title', 'Data dokter')

@section('content-admin')

<style>
    .pastel-card {
        background-color: #fff;
    }

    .pastel-header {
        background-color: #bce0d1 !important;
        color: #2c3e50 !important;
    }

    .pastel-label {
        color: #355e54;
    }

    
    .pastel-btn {
        background-color: #a7dbc7;
        color: #17573e;
        border: none;
        transition: 0.2s;
    }
    .pastel-btn:hover {
        background-color: #97d1ba;
    }

    .pastel-outline-success {
        border: 1px solid #8ecfba;
        color: #3f7a66;
    }
    .pastel-outline-success:hover {
        background-color: #bce0d1;
        color: white;
    }

    .pastel-outline-secondary {
        border: 1px solid #ccc;
        color: #555;
    }
    .pastel-outline-secondary:hover {
        background-color: #ececec;
    }

    .pastel-danger {
        background-color: #ffdddd;
        border: 1px solid #ffbcbc;
        color: #c0392b;
    }
    .pastel-danger:hover {
        background-color: #ffc9c9;
        color: #a0261c;
    }
</style>

<div class="card shadow-sm border-0 pastel-card rounded-4">
    <div class="card-header pastel-header fw-semibold">
        <i class="bi bi-file-earmark-medical me-2"></i> Tambah dokter
    </div>

    <div class="card-body p-4">
        @if ($errors->any())
            <div class="alert pastel-danger rounded-3 p-3 mb-4" role="alert">
                <p class="fw-bold mb-2">Terjadi Kesalahan:</p>
                <ul class="list-unstyled mb-0">
                    @foreach ($errors->all() as $error)
                        <li>&bullet; {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.dokter.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="username" class="form-label pastel-label">Nama (Username)</label>
                <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" required>
            </div>

            <div class="mb-3">
                <label for="nama_dokter" class="form-label pastel-label">Nama lengkap</label>
                <input type="text" name="nama_dokter" id="nama_dokter" class="form-control" value="{{ old('nama_dokter') }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label pastel-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label pastel-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="no_telp" class="form-label pastel-label">No. Telp</label>
                <input type="text" name="no_telp" id="no_telp" class="form-control" value="{{ old('no_telp') }}" required>
            </div>

            <div class="mb-4">
                <label for="foto" class="form-label pastel-label">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control">

                <img id="preview-image" 
                    src="#" 
                    alt="Preview Foto" 
                    class="mt-3 rounded" 
                    style="display:none; width:120px; height:120px; object-fit:cover; border:1px solid #ccc;">
            </div>

            <button type="submit" class="btn pastel-btn mt-3">Simpan Data Dokter</button>
        </form>
    </div>
</div>
<script>
document.getElementById('foto').addEventListener('change', function(e) {
    const preview = document.getElementById('preview-image');

    preview.style.display = 'block';   // munculin gambar
    preview.src = URL.createObjectURL(e.target.files[0]); // generate preview
});
</script>

@endsection