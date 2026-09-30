@extends('layouts.app')

@section('content')

<div class="projects-page">

    <div class="projects-header">
        <p class="projects-label">TRASH</p>

        <h1>Project Terhapus</h1>

        <p class="projects-description">
            Daftar project yang telah dihapus dan masih dapat dipulihkan.
        </p>
    </div>

    @if ($projects->count())

        <div class="project-grid">

            @foreach ($projects as $project)

                <div class="project-card">

                    <div class="project-content">

                        <h2>{{ $project->title }}</h2>

                        <p>
                            {{ $project->description }}
                        </p>

                    <div class="project-actions">

                        <form
                            action="{{ route('projects.restore', $project->id) }}"
                            method="POST"
                        >
                            @csrf
                            @method('PATCH')

                            <button type="submit" class="restore-project-button">
                                Restore
                            </button>
                        </form>

                        <form
                            action="{{ route('projects.forceDelete', $project->id) }}"
                            method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus project ini secara permanen?');"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="permanent-delete-button">
                                Hapus Permanen
                            </button>
                        </form>

                    </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="empty-project">
            <p>Trash masih kosong.</p>
        </div>

    @endif

</div>

@endsection