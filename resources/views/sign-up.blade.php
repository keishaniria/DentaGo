@extends('layout.app')

@section('title', 'Sign up to DentaGo')

@section('content')
<style>
    body{
        font-family: 'Poppins', sans-serif;
        background-color: #F4F6F9;
        margin: 0;
    }

    .box-area{
        width: 930px;
        margin: auto;
    }

    .right-box{
        padding: 40px 30px 40px;
    }

    ::placeholder{
        font-size: 16px;
    }

    @media only screen and (max-width: 768px){
        .box-area{
            margin: 0 10px;

        }

        .left-box{
            /* width: auto; */
            height: 150px;
            overflow: hidden;
        }

        .right-box{
            padding: 20px;
        }
    }
</style>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="row border rounded-5 p-3 bg-white shadow box-area">

        <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #bce0d1;">
            <div class="featured-image mb-3">
                <img src="{{ asset('images/image2.png') }}" class="img-fluid" style="width: 250px;">
            </div>
            <p class="fs-2" style="color: #243447; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight:600">Ayo jaga kesehatan gigimu!</p>
            <small>Masuk/daftar untuk mulai reservasi</small>
        </div>

        <div class="col-md-6 right-box">
            <div class="row align-items-center">
                <div class="header-text mb-4">
                    <h2>Halo!</h2>
                    <p>Segera daftarkan dirimu agar reservasi menjadi mudah.</p>
                </div>
                <form action="{{ route('signup.submit') }}" method="POST">
                    @csrf
                    <div class="input-group mb-4">
                        <input type="text" name="username" class="form-control form-control-lg bg-light fs-6" placeholder="Nama lengkap">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="email" class="form-control form-control-lg bg-light fs-6" placeholder="Alamat email">
                    </div>
                    <div class="input-group mb-4">
                        <input type="password" name="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password">
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-lg w-100 fs-6" style="background-color:#bce0d1;">Daftar</button>
                    </div>
                    <div class="input-group mb-3">
                        <small>Sudah punya akun? <a href="/sign-in">Masuk</a> di sini ya!</small>
                    </div>
                </form>
            </div>
        </div>
    
    </div>

</div>
@endsection