@extends('layouts.app')
@section('content')

<div class="projects-page">

    <div class="projects-header">
        <p class="projects-label">EDIT PROJECT</p>

        <h1>Edit Project</h1>

        <p class="projects-description">
            Perbarui informasi project yang telah tersimpan.
        </p>
    </div>

    <div class="edit-project-card">

        @if ($errors->any())
            <div class="form-errors">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('projects.update', $project->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Judul Project</label>

                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title', $project->title) }}"
                    required
                >
            </div>

            <div class="form-group">
                <label for="description">Deskripsi Project</label>

                <textarea
                    name="description"
                    id="description"
                    required
                >{{ old('description', $project->description) }}</textarea>
            </div>

            <div class="form-actions">

                <a href="{{ route('projects.show', $project->id) }}" class="cancel-button">
                    Batal
                </a>

                <button type="submit" class="save-button">
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection