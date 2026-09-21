@extends('layouts.app')

@section('content')

<div class="projects-page">

    <div class="projects-header">
        <p class="projects-label">MY WORK</p>
        <h1>My Projects</h1>
        <p class="projects-description">
            Beberapa project yang pernah saya kerjakan selama belajar
            web development dan pengembangan aplikasi.
        </p>
    </div>

    @if(count($projects))

        <div class="project-grid">

            @foreach($projects as $project)

                <div class="project-card">

                    <div class="project-number">
                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                    </div>

                    <div class="project-content">

                        <h2>{{ $project->title }}</h2>

                        <p>
                            {{ $project->description }}
                        </p>

                        <a href="{{ route('projects.show', $project->id) }}"
                        class="project-button">
                        Lihat Detail →
                        </a>

                    </div>

                </div>

            @endforeach

        </div>

        <div class="add-project">
         <a href="{{ route('projects.create') }}" class="btn-primary">
             + Tambah Project
         </a>
        </div>
        
    @else

        <div class="empty-project">
            <p>Belum ada project.</p>
        </div>

    @endif

</div>

@endsection