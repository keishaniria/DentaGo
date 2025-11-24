@extends('admin.layout.dashboard')

@section('title', 'Tambah Dokter')

@section('content-admin')

<style>
.pastel-card {
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    max-width: 800px;  /* Sedang, tidak terlalu kecil */
    margin: 0 auto;
}

.pastel-header {
    background-color: #bce0d1 !important;
    color: #2c3e50 !important;
    font-weight: 600;
    font-size: 16px;
}

.pastel-label {
    color: #355e54;
    font-weight: 500;
    font-size: 14px;
}

.pastel-btn {
    background-color: #a7dbc7;
    color: #17573e;
    border: none;
    padding: 8px 18px;
    font-weight: 600;
    border-radius: 6px;
    font-size: 14px;
    transition: 0.2s;
}

.pastel-btn:hover {
    background-color: #97d1ba;
}

.pastel-danger {
    background-color: #ffdddd;
    border: 1px solid #ffbcbc;
    color: #c0392b;
    font-size: 13px;
}

.pastel-danger ul {
    margin: 0;
    padding-left: 16px;
}

.img-preview {
    display: none;
    width: 100px;
    height: 100px;
    object-fit: cover;
    border: 1px solid #ccc;
    border-radius: 8px;
    margin-top: 8px;
}

.form-control {
    font-size: 14px;
    padding: 8px 12px;
}
</style>

<div class="card pastel-card shadow-sm border-0">
    <div class="card-header pastel-header">
        <i class="bi bi-person-fill me-2"></i> Tambah Dokter
    </div>
    <div class="card-body p-4">

        @if ($errors->any())
        <div class="alert pastel-danger rounded-3 p-3 mb-3" role="alert">
            <p class="fw-bold mb-1">Terjadi Kesalahan:</p>
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
                <label class="form-label pastel-label" for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label pastel-label" for="nama_dokter">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_dokter" name="nama_dokter" value="{{ old('nama_dokter') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label pastel-label" for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label pastel-label" for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label class="form-label pastel-label" for="no_telp">No. Telp</label>
                <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ old('no_telp') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label pastel-label" for="foto">Foto</label>
                <input type="file" class="form-control" id="foto" name="foto">
                <img id="preview-image" class="img-preview" alt="Preview Foto">
            </div>

            <button type="submit" class="btn pastel-btn w-100">Simpan Dokter</button>
        </form>
    </div>
</div>

<script>
document.getElementById('foto').addEventListener('change', function(e){
    const preview = document.getElementById('preview-image');
    if (e.target.files && e.target.files[0]) {
        preview.style.display = 'block';
        preview.src = URL.createObjectURL(e.target.files[0]);
    } else {
        preview.style.display = 'none';
        preview.src = '#';
    }
});
</script>

@endsection
