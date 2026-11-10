
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | MyPortfolio</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f8f9fc;
            color: #354052;
        }

        .navbar {
            background: white;
            padding: 22px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #f4dce8;
        }

        .logo {
            font-size: 25px;
            font-weight: bold;
        }

        .logo span {
            color: #e64b91;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav-right a {
            text-decoration: none;
            color: #354052;
            font-weight: bold;
        }

        .logout {
            background: linear-gradient(120deg, #e64b91, #20bd68);
            color: white !important;
            padding: 12px 20px;
            border-radius: 10px;
        }

        .container {
            max-width: 1250px;
            margin: 45px auto;
            padding: 0 25px;
        }

        .welcome {
            padding: 40px;
            border-radius: 24px;
            background: linear-gradient(120deg, #fff6fa, #effff6);
            border: 1px solid #f5dce9;
            margin-bottom: 30px;
        }

        .welcome small {
            color: #e64b91;
            font-weight: bold;
            letter-spacing: 3px;
        }

        .welcome h1 {
            font-size: 34px;
            margin: 18px 0 12px;
        }

        .welcome p {
            color: #68758b;
            font-size: 16px;
        }

        .section-title {
            margin: 35px 0 20px;
            font-size: 23px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 22px;
        }

        .card {
            background: white;
            border: 1px solid #f3dce8;
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 8px 30px rgba(40, 50, 70, .04);
        }

        .card-label {
            color: #778197;
            font-size: 15px;
        }

        .card h2 {
            font-size: 36px;
            margin-top: 15px;
            color: #354052;
        }

        .card .accent {
            color: #e64b91;
        }

        .actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 22px;
        }

        .action-card h3 {
            margin-bottom: 13px;
        }

        .action-card p {
            color: #778197;
            line-height: 1.6;
            margin-bottom: 22px;
        }

        .action-card a {
            color: #e64b91;
            font-weight: bold;
            text-decoration: none;
        }

        .footer {
            text-align: center;
            padding: 30px;
            color: #9299a8;
        }

        @media (max-width: 600px) {
            .navbar {
                flex-direction: column;
                gap: 18px;
            }

            .nav-right {
                flex-wrap: wrap;
                justify-content: center;
            }

            .welcome {
                padding: 25px;
            }

            .welcome h1 {
                font-size: 27px;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="logo">My<span>Portfolio</span></div>

        <div class="nav-right">
            <a href="{{ route('home') }}">Website</a>
            <a href="{{ route('profile.edit') }}">Profil</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout"
                    style="border: none; cursor: pointer; font-size: 14px;">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <main class="container">

        <section class="welcome">
            <small>ADMINISTRATOR PANEL</small>

            <h1>Selamat datang, {{ $adminName }}!</h1>

            <p>
                Kelola project dan informasi portfolio kamu
                melalui halaman administrator.
            </p>
        </section>

        <h2 class="section-title">Ringkasan Dashboard</h2>

        <section class="stats">
            <div class="card">
                <div class="card-label">Total Project</div>
                <h2 class="accent">{{ $totalProjects }}</h2>
                <p style="color:#9299a8; margin-top:8px;">
                    Project dalam portfolio
                </p>
            </div>

            <div class="card">
                <div class="card-label">Status Akun</div>
                <h2 style="font-size:25px; color:#20a866;">
                    Administrator
                </h2>
                <p style="color:#9299a8; margin-top:8px;">
                    Hak akses pengelolaan
                </p>
            </div>
        </section>

        <h2 class="section-title">Pengelolaan Portfolio</h2>

        <section class="actions">
            <div class="card action-card">
                <h3>Project Portfolio</h3>
                <p>
                    Lihat dan kelola seluruh project
                    yang ditampilkan pada website portfolio.
                </p>
                <a href="{{ route('projects.index') }}">
                    Kelola Project →
                </a>
            </div>

            <div class="card action-card">
                <h3>Tambah Project</h3>
                <p>
                    Tambahkan project baru agar dapat
                    ditampilkan pada halaman portfolio.
                </p>
                <a href="{{ route('projects.create') }}">
                    Tambah Project →
                </a>
            </div>

            <div class="card action-card">
                <h3>Project Terhapus</h3>
                <p>
                    Lihat project yang telah dihapus
                    dan pulihkan jika diperlukan.
                </p>
                <a href="{{ route('projects.trash') }}">
                    Lihat Trash →
                </a>
            </div>

            <div class="card action-card">
                <h3>Pengaturan Profil</h3>
                <p>
                    Perbarui informasi nama, email,
                    dan kata sandi akun administrator.
                </p>
                <a href="{{ route('profile.edit') }}">
                    Kelola Profil →
                </a>
            </div>
        </section>

    </main>

    <footer class="footer">
        © {{ date('Y') }} MyPortfolio. Admin Dashboard.
    </footer>

</body>
</html>
