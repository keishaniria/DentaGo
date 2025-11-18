@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
    <style>
		body {
			font-family: 'Poppins', sans-serif;
			background-color: #F4F6F9;
			margin: 0;
		}

		.sidebar {
			position: fixed;
			top: 0;
            left: 0;
			height: 100vh;
			width: 250px;
			background-color: #243447;
			color: #ECF0F1;
			padding-top: 20px;
			box-shadow: 2px 0 10px rgba(0,0,0,0.1);
		}
		.sidebar .brand {
			font-size: 22px;
			font-weight: 700;
			color: #4BC590;
			text-align: center;
			margin-bottom: 40px;
		}
		.sidebar .nav {
			list-style: none;
			padding: 0;
			margin: 0;
		}
		.sidebar .nav li {
			margin: 8px 0;
		}
		.sidebar .nav a {
			color: #ECF0F1;
			display: flex;
			align-items: center;
			gap: 10px;
			text-decoration: none;
			padding: 12px 20px;
			font-weight: 500;
			transition: all 0.3s ease;
			border-left: 4px solid transparent;
		}
		.sidebar .nav a:not(.logout):hover,
		.sidebar .nav a:not(.logout).active {
			background-color: #2F4257;
			color: #4BC590;
			border-left: 4px solid #4BC590;
			box-shadow: inset 2px 2px 5px rgba(0,0,0,0.25);
            transform: translateY(1px);
			transition: all 0.2s ease;
		}
		.sidebar .nav a.logout {
            color: #E74C3C;
			border-left: 4px solid transparent;
			transition: all 0.3s ease;
		}
		.sidebar .nav a i {
			font-size: 18px;
		}

		.navbar-custom{
			margin-left: 250px;
			height: 65px;
			background-color: #ffffff;
			box-shadow: 0 2px 5px rgba(0,0,0,0.08);
			display: flex;
			align-items: center;
			justify-content: flex-end;
			padding: 0 30px;
			position: sticky;
			top: 0;
			z-index: 99;
		}
		.profile {
			display: flex;
			align-items: center;
			gap: 10px;
			cursor: pointer;
		}
		.profile img {
			width: 40px;
			height: 40px;
			border-radius: 50%;
			object-fit: cover;
			border: 2px solid #ddd;
			transition: all 0.3s ease;
		}
		.profile img:hover {
			border-color: #4BC590;
			transform: scale(1.05);
		}
		.profile span {
			font-weight: 500;
			color: #333;
		}

		.content {
			margin-left: 250px;
			padding: 40px 50px;
			background-color: #f9fbfc;
			min-height: 100vh;
		}
        .content h4 {
			color: #243447;
			font-weight: 700;
			font-size: 26px;
			margin-bottom: 8px;
			display: flex;
			align-items: center;
			gap: 6px;
		}
		.content h4::after{
			font-size: 22px;
		}
		.content p {
			color: #555;
			font-size: 15.5px;
			line-height: 1.7;
			max-width: 700px;
			margin-bottom: 35px;
		}
		.content span {
			color: #4BC590;
			font-weight: 700;
		}
		.content strong {
			color: #243447;
		}

		.card-container {
			display: flex;
			flex-wrap: wrap;
			gap: 20px;
			margin-top: 30px;
		}
		.card-dashboard {
			flex: 1;
			min-width: 250px;
			background-color: #ffffff;
			border-radius: 25px;
			text-align: center;
			transition: all 0.3s ease;
			border-top: 4px solid #4BC590;
		}
		.card-dashboard:hover {
			transform: translateY(-5px);
			box-shadow: 0 6px 15px rgba(0,0,0,0.15);
		}
		.card-dashboard i {
			font-size: 35px;
			color: #4BC590;
			margin-bottom: 10px;
		}
		.card-dashboard h5 {
			font-size: 16px;
			font-weight: 600;
			color: #243447;
			margin-bottom: 8px;
		}
		.card-dashboard p {
			color: #666;
			font-size: 14px;
			margin: 0;
		}
	</style>
</head>
<body>
	<div class="sidebar">
		<div class="brand">DentaGo</div>
		<ul class="nav">
			<a href="{{ route('pasien.dashboard') }}" class="{{ request()->routeIs('pasien.dashboard') ? 'active' : '' }}"><i class="bi bi-house-door"></i>Dashboard</a>
		    <a href="{{ route('pasien.reservasi') }}" class="{{ request()->routeIs('pasien.reservasi') ? 'active' : '' }}"><i class="bi bi-clipboard-plus"></i>Buat Reservasi</a>
		    <a href="{{ route('pasien.riwayatpemeriksaan') }}" class="{{ request()->routeIs('pasien.riwayatpemeriksaan') ? 'active' : '' }}"><i class="bi bi-clock-history"></i>Riwayat Pemeriksaan</a>
		    <li>
            <a href="{{ route('logout') }}" class="logout"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </a>
        </li>
 

    <!-- Form logout HARUS di luar <li> -->
		<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
			@csrf
		</form>
		</ul>
	</div>

	<nav class="navbar-custom">
		<div class="dropdown profile">
			<img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="Foto Profil">
			<span class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
				Kamaya Nadeleine
			</span>
			<ul class="dropdown-menu dropdown-menu-end">
				<li><a class="dropdown-item" href="{{ route('pasien.profilesaya') }}">Profil Saya</a></li>
			</ul>
		</div>
	</nav>

@endsection