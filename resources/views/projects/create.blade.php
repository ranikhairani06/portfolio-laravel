@extends('layouts.app')

@section('content')

<div class="container" style="max-width: 700px; margin: 50px auto;">

    <h1 style="margin-bottom: 30px;">Tambah Project</h1>

    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Judul Project --}}
        <div style="margin-bottom: 20px;">
            <label for="title" style="display: block; margin-bottom: 8px;">
                Judul Project
            </label>

            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title') }}"
                style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;"
                required
            >

            @error('title')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        {{-- Deskripsi Project --}}
        <div style="margin-bottom: 20px;">
            <label for="description" style="display: block; margin-bottom: 8px;">
                Deskripsi Project
            </label>

            <textarea
                id="description"
                name="description"
                rows="6"
                style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;"
                required
            >{{ old('description') }}</textarea>

            @error('description')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        {{-- Kategori Project --}}
        <div style="margin-bottom: 20px;">
            <label for="category_id" style="display: block; margin-bottom: 8px;">
                Kategori Project
            </label>

            <select
                id="category_id"
                name="category_id"
                style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;"
            >
                <option value="">-- Pilih Kategori --</option>

                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            @error('category_id')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        {{-- Skill Project --}}
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 12px;">
                Skill yang Digunakan
            </label>

            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px;">

                @foreach ($skills as $skill)
                    <label style="display: flex; align-items: center; gap: 8px;">
                        <input
                            type="checkbox"
                            name="skills[]"
                            value="{{ $skill->id }}"
                            {{ in_array($skill->id, old('skills', [])) ? 'checked' : '' }}
                        >

                        {{ $skill->name }}
                    </label>
                @endforeach

            </div>

            @error('skills')
                <small style="color: red;">{{ $message }}</small>
            @enderror

            @error('skills.*')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        {{-- Thumbnail Project --}}
        <div style="margin-bottom: 20px;">
            <label for="thumbnail" style="display: block; margin-bottom: 8px;">
                Thumbnail Project
            </label>

            <input
                type="file"
                id="thumbnail"
                name="thumbnail"
                accept="image/jpeg,image/png,image/webp"
                style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;"
            >

            <small style="color: #777;">
                Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                Ukuran gambar minimal 400 x 300 piksel.
            </small>

            @error('thumbnail')
                <br>
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        {{-- Tombol Simpan --}}
        <button
            type="submit"
            style="padding: 12px 25px; border: none; border-radius: 8px; background: #d14b8f; color: white; cursor: pointer;"
        >
            Simpan
        </button>

        <a
            href="{{ route('projects.index') }}"
            style="margin-left: 12px; color: #777; text-decoration: none;"
        >
            Batal
        </a>

    </form>

</div>

@endsection
