@extends('layouts.app')

@section('content')

@if (session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
@endif

<div class="projects-page">

    <div class="projects-header">
        <p class="projects-label">MY WORK</p>
        <h1>My Projects</h1>
        <p class="projects-description">
            Beberapa project yang pernah saya kerjakan selama belajar
            web development dan pengembangan aplikasi.
        </p>
    </div>

    <form action="{{ route('projects.index') }}" method="GET" class="project-search-form">
        <input
            type="text"
            name="search"
            placeholder="Cari judul project..."
            value="{{ $search }}"
        >

        <select name="per_page" onchange="this.form.submit()">
            <option value="5" {{ $perPage === 5 ? 'selected' : '' }}>5 data</option>
            <option value="10" {{ $perPage === 10 ? 'selected' : '' }}>10 data</option>
            <option value="25" {{ $perPage === 25 ? 'selected' : '' }}>25 data</option>
        </select>

        <button type="submit">Cari</button>

        @if ($search !== '')
            <a href="{{ route('projects.index') }}" class="search-reset">
                Reset
            </a>
        @endif
    </form>

    @if(count($projects))

        <div class="project-grid">

            @foreach($projects as $project)

                <div class="project-card">

                    <div class="project-number">
                        {{ $projects->firstItem() + $loop->index }}
                    </div>

                    {{-- Thumbnail Project --}}
                    <div class="project-thumbnail">
                        @if ($project->thumbnail)
                            <img
                                src="{{ asset('storage/' . $project->thumbnail) }}"
                                alt="Thumbnail {{ $project->title }}"
                            >
                        @else
                            <div class="thumbnail-placeholder">
                                Belum ada thumbnail
                            </div>
                        @endif
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

        <div class="pagination-meta" aria-label="Informasi halaman">
            <span>Halaman: {{ $projects->currentPage() }}</span>
            <span>Jumlah Data: {{ $projects->total() }}</span>
            <span>Data Per Halaman: {{ $projects->perPage() }}</span>
        </div>

        @if ($projects->lastPage() > 1)
            @php
                $startPage = max(1, min($projects->currentPage() - 1, $projects->lastPage() - 3));
                $endPage = min($projects->lastPage(), $startPage + 3);
            @endphp

            <nav class="projects-pagination" aria-label="Navigasi project">

                @if ($projects->onFirstPage())
                    <span class="pager-text is-disabled" aria-disabled="true">« Previous</span>
                @else
                    <a class="pager-text" href="{{ $projects->previousPageUrl() }}">« Previous</a>
                @endif

                @if ($projects->hasMorePages())
                    <a class="pager-text" href="{{ $projects->nextPageUrl() }}">Next »</a>
                @else
                    <span class="pager-text is-disabled" aria-disabled="true">Next »</span>
                @endif

                <span class="pager-summary">
                    <span>Showing</span>
                    <span class="pager-count">{{ $projects->firstItem() }}</span>
                    <span>to</span>
                    <span class="pager-count">{{ $projects->lastItem() }}</span>
                    <span>of</span>
                    <span class="pager-count">{{ $projects->total() }}</span>
                    <span>results</span>
                </span>

                <span class="pager-pages" aria-label="Nomor halaman">

                    @if ($projects->onFirstPage())
                        <span class="page-control is-disabled" aria-disabled="true" aria-label="Halaman sebelumnya">‹</span>
                    @else
                        <a class="page-control" href="{{ $projects->previousPageUrl() }}" aria-label="Halaman sebelumnya">‹</a>
                    @endif

                    @for ($page = $startPage; $page <= $endPage; $page++)
                        @if ($page === $projects->currentPage())
                            <span class="page-number is-current" aria-current="page">{{ $page }}</span>
                        @else
                            <a class="page-number" href="{{ $projects->url($page) }}">{{ $page }}</a>
                        @endif
                    @endfor

                    @if ($projects->hasMorePages())
                        <a class="page-control" href="{{ $projects->nextPageUrl() }}" aria-label="Halaman berikutnya">›</a>
                    @else
                        <span class="page-control is-disabled" aria-disabled="true" aria-label="Halaman berikutnya">›</span>
                    @endif

                </span>
            </nav>
        @endif

        <div class="add-project">
            <a href="{{ route('projects.create') }}" class="btn-primary">
                + Tambah Project
            </a>

            <a href="{{ route('projects.trash') }}" class="btn-primary">
                🗑 Trash
            </a>
        </div>

    @else

        <div class="empty-project">
            <p>Belum ada project.</p>
        </div>

    @endif

</div>

@endsection
