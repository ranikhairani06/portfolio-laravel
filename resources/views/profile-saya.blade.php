
@extends('layouts.app')

@section('content')

<style>
    .profile-page {
        max-width: 1100px;
        margin: 55px auto;
        padding: 0 25px;
        color: #354052;
    }

    .profile-heading {
        margin-bottom: 30px;
    }

    .profile-heading small {
        color: #e64b91;
        font-weight: bold;
        letter-spacing: 3px;
    }

    .profile-heading h1 {
        font-size: 36px;
        margin: 12px 0;
    }

    .profile-heading p {
        color: #68758b;
    }

    .profile-card {
        background: white;
        border: 1px solid #f3dce8;
        border-radius: 22px;
        padding: 35px;
        box-shadow: 0 10px 35px rgba(40, 50, 70, .04);
    }

    .profile-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
        padding-bottom: 25px;
        border-bottom: 1px solid #f3dce8;
    }

    .profile-avatar {
        width: 75px;
        height: 75px;
        border-radius: 50%;
        background: linear-gradient(135deg, #f5a4ca, #b7e9c9);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 30px;
        font-weight: bold;
    }

    .profile-header h2 {
        font-size: 24px;
        margin-bottom: 7px;
    }

    .profile-header p {
        color: #778197;
    }

    .profile-info {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .info-item {
        background: #fff8fb;
        border: 1px solid #f5e3ed;
        border-radius: 14px;
        padding: 20px;
    }

    .info-item span {
        display: block;
        color: #8991a1;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .info-item strong {
        font-size: 16px;
        color: #354052;
    }

    .role-badge {
        display: inline-block;
        background: #e8f9ef;
        color: #20985a;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 13px;
    }

    .profile-note {
        margin-top: 25px;
        padding: 18px;
        background: #f5fbf7;
        border-radius: 12px;
        color: #68758b;
        font-size: 14px;
    }

    @media (max-width: 600px) {
        .profile-info {
            grid-template-columns: 1fr;
        }

        .profile-card {
            padding: 22px;
        }

        .profile-heading h1 {
            font-size: 28px;
        }
    }
</style>

<div class="profile-page">

    <div class="profile-heading">
        <small>ACCOUNT INFORMATION</small>
        <h1>Profil Saya</h1>
        <p>Informasi akun yang sedang digunakan pada MyPortfolio.</p>
    </div>

    <div class="profile-card">

        <div class="profile-header">
            <div class="profile-avatar">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>

            <div>
                <h2>{{ $user->name }}</h2>
                <p>{{ $user->email }}</p>
            </div>
        </div>

        <h3 style="margin-bottom: 20px;">Informasi Akun</h3>

        <div class="profile-info">

            <div class="info-item">
                <span>Nama Lengkap</span>
                <strong>{{ $user->name }}</strong>
            </div>

            <div class="info-item">
                <span>Alamat Email</span>
                <strong>{{ $user->email }}</strong>
            </div>

            <div class="info-item">
                <span>Role Pengguna</span>
                <strong>
                    <span class="role-badge">
                        {{ ucfirst($user->role) }}
                    </span>
                </strong>
            </div>

            <div class="info-item">
                <span>Status Akun</span>
                <strong style="color: #20985a;">Aktif</strong>
            </div>

        </div>

        <div class="profile-note">
            Halaman ini menampilkan informasi akun pengguna yang
            sedang login ke dalam website MyPortfolio.
        </div>

    </div>

</div>

@endsection
