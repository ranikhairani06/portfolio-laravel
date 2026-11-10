@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <section class="dashboard-page">
        <div class="dashboard-welcome">
            <div>
                <p class="dashboard-eyebrow">AREA PENGELOLAAN</p>
                <h1>Selamat datang, {{ Auth::user()->name }}</h1>
                <p>Kelola portofolio dan informasi akunmu dari satu tempat.</p>
            </div>
            <a href="{{ route('projects.index') }}" class="btn-primary">Kelola Project</a>
        </div>

        <div class="dashboard-grid">
            <a href="{{ route('projects.index') }}" class="dashboard-card">
                <span class="dashboard-card-number">01</span>
                <h2>Project Portofolio</h2>
                <p>Lihat, tambah, dan kelola project yang tampil di portofoliomu.</p>
                <span class="dashboard-card-link">Buka daftar project <span aria-hidden="true">→</span></span>
            </a>

            <a href="{{ route('profile.edit') }}" class="dashboard-card">
                <span class="dashboard-card-number">02</span>
                <h2>Pengaturan Akun</h2>
                <p>Perbarui nama, email, atau kata sandi akunmu.</p>
                <span class="dashboard-card-link">Kelola akun <span aria-hidden="true">→</span></span>
            </a>
        </div>
    </section>
@endsection
