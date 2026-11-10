@extends('layouts.app')

@section('content')

<div class="project-detail-page">

    <div class="project-detail">

        {{-- KEMBALI --}}
        <a href="{{ route('projects.index') }}" class="back-button">
            ← Kembali ke Projects
        </a>

        <p class="project-label">PROJECT DETAIL</p>

        {{-- JUDUL --}}
        <h1>{{ $project->title }}</h1>

        {{-- THUMBNAIL UTAMA --}}
        @if ($project->thumbnail)

            <div class="project-detail-thumbnail">
                <img
                    src="{{ asset('storage/' . $project->thumbnail) }}"
                    alt="Thumbnail {{ $project->title }}"
                >
            </div>

        @else

            <div class="project-detail-thumbnail-placeholder">
                Belum ada thumbnail
            </div>

        @endif

        {{-- DESKRIPSI --}}
        <div class="project-detail-content">

            <h2>Deskripsi</h2>

            <p>
                {{ $project->description }}
            </p>

        </div>

        {{-- PROJECT GALLERY --}}
        <div class="gallery-section">

            <div class="gallery-heading">

                <div>
                    <p class="gallery-label">PROJECT PHOTOS</p>

                    <h2>Project Gallery</h2>

                    <p class="gallery-description">
                        Dokumentasi dan hasil dari project ini.
                    </p>
                </div>

                <span class="gallery-count">
                    {{ $project->images->count() }} Foto
                </span>

            </div>

            {{-- DAFTAR FOTO --}}
            <div class="gallery-grid">

                @forelse ($project->images as $image)

                    <div class="gallery-card">

                        <img
                            src="{{ asset('storage/' . $image->image) }}"
                            alt="{{ $image->caption ?? $project->title }}"
                        >

                    </div>

                @empty

                    <div class="gallery-empty">
                        <span>▧</span>

                        <h3>Belum Ada Foto</h3>

                        <p>
                            Dokumentasi project belum tersedia.
                        </p>
                    </div>

                @endforelse

            </div>

        </div>

        {{-- TOMBOL AKSI --}}
        <div class="project-actions">

            <a
                href="{{ route('projects.edit', $project->id) }}"
                class="edit-project-button"
            >
                Edit Project
            </a>

            <form
                action="{{ route('projects.destroy', $project->id) }}"
                method="POST"
                onsubmit="return confirm('Apakah Anda yakin ingin menghapus project ini?');"
            >
                @csrf
                @method('DELETE')

                <button type="submit" class="delete-project-button">
                    Hapus Project
                </button>
            </form>

        </div>

    </div>

</div>

@endsection
