<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="auth-body">
        <main class="auth-page">
            <a href="{{ route('home') }}" class="auth-brand" aria-label="MyPortfolio, kembali ke beranda">
                My<span>Portfolio</span>
            </a>

            <section class="auth-card">
                <div class="auth-card-heading">
                    <p class="auth-eyebrow">AREA PENGELOLAAN</p>
                    <h1>Selamat datang kembali</h1>
                    <p>Masuk untuk mengelola project portofoliomu.</p>
                </div>

                {{ $slot }}

                <a href="{{ route('home') }}" class="auth-back-link">Kembali ke portofolio</a>
            </section>
        </main>
    </body>
</html>
