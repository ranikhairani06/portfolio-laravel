@extends('layouts.app')

@section('title', 'Projects')

@section('content')

<section class="page">

    <div class="page-header">

        <h1>
            My <span class="gradient-text">Projects</span>
        </h1>

        <p>
            Beberapa project yang pernah saya kerjakan.
        </p>

    </div>


    <div class="project-grid">

        <div class="project-card">

            <div class="project-icon">
                🌐
            </div>

            <h2>Portfolio Website</h2>

            <p>
                Website portfolio pribadi yang dibuat menggunakan
                Laravel dan Blade Templating.
            </p>

            <span class="project-tag">
                Laravel
            </span>

        </div>


        <div class="project-card">

            <div class="project-icon">
                📚
            </div>

            <h2>Sistem Manajemen TPA</h2>

            <p>
                 Sistem berbasis web untuk mengelola data santri, kelas, hafalan, dan absensi.
            </p>

            <span class="project-tag">
                Web Development
            </span>

        </div>


        <div class="project-card">

            <div class="project-icon">
                💻
            </div>

            <h2>Simple Web Project</h2>

            <p>
                Project website sederhana yang dibuat untuk
                mempelajari dasar-dasar pengembangan web.
            </p>

            <span class="project-tag">
                PHP
            </span>

        </div>

    </div>

</section>

@endsection