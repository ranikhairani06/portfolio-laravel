@extends('layouts.app')
@section('title', 'About')
@section('content')

<section class="page">

    <div class="page-header">
        <h1>About <span class="gradient-text">Me</span></h1>

        <p>
            Sedikit cerita tentang saya.
        </p>
    </div>


    <div class="about-grid">

        <div class="profile-card">

            <div class="profile-icon">
                👩🏻‍💻
            </div>

            <h2>Nikmah Putri Khairani</h2>

            <p>
                Student & Web Development Enthusiast
            </p>

        </div>


        <div class="about-card">

            <h2>Hello! 👋</h2>

            <p>
                Saya adalah seseorang yang sedang belajar
                mengenai pengembangan website dan teknologi informasi.
            </p>

            <p>
                Saat ini saya sedang mempelajari bagaimana membuat
                website menggunakan Laravel, PHP, Blade, HTML, CSS,
                dan berbagai teknologi web lainnya.
            </p>

            <p>
                Website portfolio ini dibuat sebagai bagian dari
                proses pembelajaran saya dalam memahami Laravel
                dan Blade Templating.
            </p>

        </div>

    </div>

</section>

@endsection