<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DentaGo</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            overflow-x: hidden;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background-color: #243447;
            color: #ecf0f1;
            padding-top: 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 200;
        }

        .sidebar .brand {
            font-size: 22px;
            font-weight: 700;
            color: #bce0d1;
            text-align: center;
            margin-bottom: 40px;
        }

        .sidebar .nav {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .sidebar .nav li {
            margin: 8px 0;
            width: 100%;
        }

        .sidebar .nav a {
            color: #ecf0f1;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            padding: 12px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            width: 100%;
            white-space: nowrap;
        }

        .sidebar .nav a:hover,
        .sidebar .nav a.active {
            background-color: #34495e;
            color: #bce0d1;
            border-left: 4px solid #bce0d1;
        }

        .sidebar .nav li:last-child a {
            justify-content: flex-start !important;
        }

        .top-navbar {
            position: fixed;
            top: 0;
            left: 250px;
            width: calc(100% - 250px);
            height: 65px;
            background: #ffffff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 30px;
            z-index: 150;
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
            border: 2px solid #ddd;
        }

        .profile span {
            font-weight: 500;
            color: #333;
        }

        .content {
            margin-left: 270px;
            padding: 110px 50px 40px 50px;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="brand">
            <i class="bi bi-tooth"></i> DentaGo
        </div>
        <ul class="nav">
            <li><a href="{{ route('dokter.dashboard') }}" class="{{ request()->routeIs('dokter.dashboard') ? 'active' : '' }}"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
            <li><a href="{{ route('dokter.jadwal.index') }}" class="{{ request()->routeIs('dokter.jadwal.*') ? 'active' : '' }}"><i class="bi bi-calendar-check"></i> Jadwal Pemeriksaan</a></li>
            <li><a href="{{ route('dokter.pasien.index') }}" class="{{ request()->routeIs('dokter.pasien.*') ? 'active' : '' }}"><i class="bi bi-person-lines-fill"></i> Data Pasien</a></li>
            <li><a href="{{ route('dokter.laporan.index') }}" class="{{ request()->routeIs('dokter.laporan.*') ? 'active' : '' }}"><i class="bi bi-file-earmark-text"></i> Laporan</a></li>
            <li>
                <a href="{{ route('logout') }}" class="logout"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </a>
            </li>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </ul>
    </div>

    <nav class="top-navbar">
        <div class="dropdown profile">
            <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="Foto Profil">
            @php
            use Illuminate\Support\Facades\Auth;
            @endphp

            <span class="dropdown-toggle" data-bs-toggle="dropdown">
                {{ Auth::user()->username }}
            </span>

            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="{{ route('dokter.profil.index') }}">
                        Profil Saya
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="content">
        @yield('content-dokter')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>