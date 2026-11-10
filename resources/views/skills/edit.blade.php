
@extends('layouts.app')

@section('content')

<div class="container" style="max-width: 650px; margin: 55px auto;">

    <div style="background: white; padding: 35px; border-radius: 16px; border: 1px solid #f5dce9;">

        <h1 style="color: #354052; margin-bottom: 10px;">
            Edit Skill
        </h1>

        <p style="color: #718096; margin-bottom: 30px;">
            Perbarui nama skill yang ingin kamu ubah.
        </p>

        @if (session('success'))
            <div style="background: #e8f8ee; color: #21834b; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('skills.update', $skill->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 25px;">

                <label for="name" style="display: block; margin-bottom: 10px; font-weight: 600;">
                    Nama Skill
                </label>

                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name', $skill->name) }}"
                    required
                    maxlength="255"
                    style="width: 100%; padding: 13px; border: 1px solid #ddd; border-radius: 8px;"
                >

                @error('name')
                    <small style="color: red;">{{ $message }}</small>
                @enderror

            </div>

            <div style="display: flex; justify-content: flex-end; gap: 12px;">

                <a
                    href="{{ route('projects.dashboard') }}"
                    style="padding: 12px 20px; color: #718096; text-decoration: none;"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    style="padding: 12px 22px; border: none; border-radius: 8px; background: #d14b8f; color: white; cursor: pointer;"
                >
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection
