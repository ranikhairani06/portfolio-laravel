@extends('layouts.app')

@section('title', 'Education')

@section('content')

<section class="page">

    <div class="page-header">

        <h1>
            My <span class="gradient-text">Education</span>
        </h1>

        <p>
            Perjalanan pendidikan saya.
        </p>

    </div>


    <div class="timeline">

        <div class="timeline-item">

            <div class="timeline-dot"></div>

            <div class="timeline-card">

                <span>Education</span>

                <h2>SMP</h2>

                <p>
                    SMPN 1 Barat Magetan
                </p>

            </div>

        </div>


        <div class="timeline-item">

            <div class="timeline-dot"></div>

            <div class="timeline-card">

                <span>Education</span>

                <h2>SMA / SMK</h2>

                <p>
                    SMAN 1 Karas Magetan
                </p>

            </div>

        </div>


        <div class="timeline-item">

            <div class="timeline-dot"></div>

            <div class="timeline-card">

                <span>Education</span>

                <h2>Universitas</h2>

                <p>
                    Universitas Gadjah Mada
                </p>

            </div>

        </div>

    </div>

</section>

@endsection