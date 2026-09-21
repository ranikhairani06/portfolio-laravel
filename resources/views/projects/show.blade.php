@extends('layouts.app')

@section('content')

<div class="project-detail-page">

    <div class="project-detail">

        <a href="{{ route('projects.index') }}" class="back-button">
            ← Kembali ke Projects
        </a>

        <p class="project-label">PROJECT DETAIL</p>

        <h1>{{ $project->title }}</h1>

        <div class="project-detail-content">

            <h2>Deskripsi</h2>
            <p>
                {{ $project->description }}
            </p>

        </div>

    </div>

</div>

@endsection