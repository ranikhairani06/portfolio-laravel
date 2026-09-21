@extends('layouts.app')
@section('title', 'Home')
@section('content')

<section class="hero">

    <div class="hero-content">

        <span class="hero-badge">
            👋 Welcome to my portfolio
        </span>

        <h1>
            Halo, Saya <br>
            <span class="gradient-text">Rani</span>
        </h1>

        <p>
            Saya sedang belajar web development dan membangun
            berbagai project menggunakan Laravel, PHP, dan teknologi web lainnya.
        </p>

        <div class="hero-buttons">

            <a href="{{ route('projects.index') }}">
            Lihat Project →
            </a>

            <a href="{{ route('about') }}" class="btn-secondary">
                Tentang Saya
            </a>

        </div>

    </div>

</section>

@endsection