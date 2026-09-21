@extends('layouts.app')

@section('content')

<div class="container" style="max-width: 700px; margin: 50px auto;">

    <h1 style="margin-bottom: 30px;">Tambah Project</h1>

    <form action="{{ route('projects.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 20px;">
            <label for="title" style="display: block; margin-bottom: 8px;">
                Judul Project
            </label>

            <input
                type="text"
                id="title"
                name="title"
                style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;"
                required
            >
        </div>

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
            ></textarea>
        </div>

        <button
            type="submit"
            style="padding: 12px 25px; border: none; border-radius: 8px; background: #d14b8f; color: white; cursor: pointer;"
        >
            Simpan
        </button>

    </form>

</div>

@endsection