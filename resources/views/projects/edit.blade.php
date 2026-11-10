@extends('layouts.app')

@section('content')

<div class="projects-page">

    <div class="projects-header">
        <p class="projects-label">EDIT PROJECT</p>
        <h1>Edit Project</h1>
        <p class="projects-description">
            Perbarui informasi project dan kelola dokumentasi gallery.
        </p>
    </div>

    <div class="edit-project-card">

        {{-- NOTIFIKASI --}}
        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="form-errors">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- FORM EDIT PROJECT --}}
        <form
            id="project-edit-form"
            action="{{ route('projects.update', $project->id) }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            {{-- JUDUL --}}
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

            {{-- DESKRIPSI --}}
            <div class="form-group">
                <label for="description">Deskripsi Project</label>

                <textarea
                    name="description"
                    id="description"
                    required
                >{{ old('description', $project->description) }}</textarea>
            </div>

            {{-- KATEGORI --}}
            <div class="form-group">
                <label for="category_id">Kategori Project</label>

                <select name="category_id" id="category_id">
                    <option value="">-- Pilih Kategori --</option>

                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id', $project->category_id) == $category->id ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            
            
            {{-- SKILL --}}
            <div class="form-group">
                <label>Skill yang Digunakan</label>

                @php
                    $selectedSkills = old(
                        'skills',
                        $project->skills->pluck('id')->toArray()
                    );
                @endphp

                <div class="skill-selection">
                    @foreach ($skills as $skill)
                        <label class="skill-option">
                            <input
                                type="checkbox"
                                name="skills[]"
                                value="{{ $skill->id }}"
                                {{ in_array($skill->id, $selectedSkills) ? 'checked' : '' }}
                            >

                            <span>{{ $skill->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>


            {{-- THUMBNAIL --}}
            <div class="form-group">
                <label for="thumbnail">Thumbnail Project</label>

                @if ($project->thumbnail)
                    <div class="current-thumbnail">
                        <p>Thumbnail saat ini:</p>

                        <img
                            src="{{ asset('storage/' . $project->thumbnail) }}"
                            alt="Thumbnail {{ $project->title }}"
                        >
                    </div>
                @else
                    <p class="thumbnail-empty">
                        Project ini belum memiliki thumbnail.
                    </p>
                @endif

                <input
                    type="file"
                    name="thumbnail"
                    id="thumbnail"
                    accept="image/jpeg,image/png,image/webp"
                >

                <small>
                    Pilih gambar baru jika ingin mengganti thumbnail.
                    JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
                    Ukuran minimal 400 x 300 piksel.
                </small>
            </div>

        </form>

        {{-- PEMISAH GALLERY --}}
        <div class="gallery-divider"></div>

        {{-- KELOLA GALLERY --}}
        <div class="gallery-management">

            <div class="gallery-heading">
                <div>
                    <p class="gallery-label">PROJECT PHOTOS</p>
                    <h2>Kelola Project Gallery</h2>
                    <p class="gallery-description">
                        Tambahkan atau hapus foto dokumentasi project.
                    </p>
                </div>

                <span class="gallery-count">
                    {{ $project->images->count() }} Foto
                </span>
            </div>

            {{-- FORM UPLOAD GALLERY --}}
            <form
                action="{{ route('projects.gallery.store', $project->id) }}"
                method="POST"
                enctype="multipart/form-data"
                class="gallery-upload-card"
            >
                @csrf

                <div class="upload-icon">＋</div>

                <h3>Tambahkan Foto Project</h3>

                <p>Pilih beberapa gambar sekaligus dari perangkatmu.</p>

                <label for="gallery-images" class="gallery-file-label">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="21"
                        height="21"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <rect x="3" y="3" width="18" height="18" rx="3"/>
                        <circle cx="8.5" cy="8.5" r="1.5"/>
                        <path d="m21 15-5-5L5 21"/>
                    </svg>

                    <span id="gallery-file-text">Pilih Gambar</span>
                </label>

                <input
                    type="file"
                    name="images[]"
                    id="gallery-images"
                    accept="image/jpeg,image/png,image/webp"
                    multiple
                    required
                    hidden
                >

                <div class="gallery-file-info">
                    JPG, JPEG, PNG, WEBP
                    <span>•</span>
                    Maksimal 10 gambar
                    <span>•</span>
                    4 MB per gambar
                </div>

                @error('images')
                    <p class="form-error">{{ $message }}</p>
                @enderror

                @error('images.*')
                    <p class="form-error">{{ $message }}</p>
                @enderror

                <button type="submit" class="gallery-upload-button">
                    Upload Gallery
                </button>
            </form>

            {{-- JAVASCRIPT PILIH GAMBAR --}}
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const input = document.getElementById('gallery-images');
                    const text = document.getElementById('gallery-file-text');

                    input.addEventListener('change', function () {
                        const total = this.files.length;

                        text.textContent = total > 0
                            ? total + ' gambar dipilih'
                            : 'Pilih Gambar';
                    });
                });
            </script>

            {{-- DAFTAR FOTO --}}
            <div class="gallery-grid">

                @forelse ($project->images as $image)

                    <div class="gallery-card">

                        <img
                            src="{{ asset('storage/' . $image->image) }}"
                            alt="{{ $image->caption ?? $project->title }}"
                        >

                        {{-- FORM EDIT CAPTION --}}
                        <form
                            action="{{ route('projects.gallery.update', [$project->id, $image->id]) }}"
                            method="POST"
                        >
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="caption-{{ $image->id }}">
                                    Caption Gambar
                                </label>

                                <input
                                    type="text"
                                    name="caption"
                                    id="caption-{{ $image->id }}"
                                    value="{{ old('caption', $image->caption) }}"
                                    placeholder="Masukkan caption gambar"
                                    maxlength="255"
                                >
                            </div>

                            <button type="submit" class="save-button">
                                Simpan Caption
                            </button>
                        </form>

                        {{-- FORM HAPUS GAMBAR --}}
                        <form
                            action="{{ route('projects.gallery.destroy', [$project->id, $image->id]) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus gambar ini?');"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="gallery-delete-button"
                            >
                                Hapus Gambar
                            </button>
                        </form>

                    </div>

                @empty

                    <div class="gallery-empty">
                        <span>▧</span>
                        <h3>Belum Ada Foto</h3>
                        <p>Foto yang kamu upload akan muncul di sini.</p>
                    </div>

                @endforelse

            </div>

        </div>

        {{-- TOMBOL AKSI PALING BAWAH --}}
        <div class="final-project-actions">

            <a
                href="{{ route('projects.show', $project->id) }}"
                class="cancel-button"
            >
                Batal
            </a>

            <button
                type="submit"
                form="project-edit-form"
                class="save-button"
            >
                Simpan Perubahan
            </button>

        </div>

    </div>

</div>

@endsection
