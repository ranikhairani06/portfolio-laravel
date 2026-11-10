@extends('layouts.app')

@section('content')

<style>
    .dashboard-page {
        max-width: 1200px;
        margin: 55px auto;
        padding: 0 25px;
    }

    .dashboard-heading {
        margin-bottom: 35px;
    }

    .dashboard-heading span {
        color: #e94b91;
        font-weight: 700;
        letter-spacing: 3px;
        font-size: 13px;
    }

    .dashboard-heading h1 {
        font-size: 38px;
        color: #354052;
        margin: 12px 0;
    }

    .dashboard-heading p {
        color: #718096;
        font-size: 16px;
    }

    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
        gap: 22px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        border: 1px solid #f5dce9;
        border-radius: 18px;
        padding: 28px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.04);
    }

    .stat-card p {
        color: #718096;
        margin-bottom: 12px;
    }

    .stat-card h2 {
        color: #354052;
        font-size: 34px;
        margin: 0;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px;
        margin-bottom: 30px;
    }

    .dashboard-section {
        background: white;
        border: 1px solid #f5dce9;
        border-radius: 18px;
        padding: 28px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.03);
        margin-bottom: 30px;
    }

    .dashboard-section h2 {
        color: #354052;
        margin-bottom: 22px;
        font-size: 22px;
    }

    .category-item,
    .skill-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid #f5e8ef;
        gap: 12px;
    }

    .category-item:last-child,
    .skill-item:last-child {
        border-bottom: none;
    }

    .item-name {
        color: #354052;
        font-weight: 600;
    }

    .item-count {
        background: #fff0f6;
        color: #e94b91;
        padding: 6px 13px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
    }

    .project-item {
        padding: 18px 0;
        border-bottom: 1px solid #f5e8ef;
        display: flex;
        justify-content: space-between;
        gap: 15px;
    }

    .project-item:last-child {
        border-bottom: none;
    }

    .project-item h3 {
        color: #354052;
        font-size: 17px;
        margin-bottom: 7px;
    }

    .project-item p {
        color: #8993a3;
        font-size: 14px;
        margin-bottom: 5px;
    }

    .empty-project {
        color: #8993a3;
        padding: 20px 0;
    }

    .dashboard-link {
        color: #e94b91;
        font-weight: 600;
        text-decoration: none;
    }

    .dashboard-link:hover {
        color: #c92e75;
    }

    .skill-actions {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .skill-edit {
        color: #e94b91;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
    }

    .skill-edit:hover {
        color: #c92e75;
    }

    .project-category {
        display: inline-block;
        background: #fff0f6;
        color: #d94387;
        padding: 5px 11px;
        border-radius: 20px;
        font-size: 12px;
        margin-top: 5px;
    }

    @media (max-width: 700px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }

        .dashboard-heading h1 {
            font-size: 29px;
        }

        .project-item {
            flex-direction: column;
        }
    }
</style>

<div class="dashboard-page">

    {{-- HEADING --}}
    <div class="dashboard-heading">
        <span>AREA PENGELOLAAN</span>

        <h1>Dashboard Admin</h1>

        <p>
            Selamat datang, {{ Auth::user()->name }}.
            Kelola project portofolio melalui halaman ini.
        </p>
    </div>

    {{-- STATISTIK --}}
    <div class="dashboard-stats">

        <x-stat-card
            title="Total Project"
            :value="$totalProjects"
            description="Seluruh project dalam portofolio"
        />

        <x-stat-card
            title="Total Categories"
            :value="$totalCategories"
            description="Seluruh kategori project"
        />

        <x-stat-card
            title="Total Skills"
            :value="$totalSkills"
            description="Seluruh skill yang tersedia"
        />

        <x-stat-card
            title="Project Published"
            :value="$publishedProjects"
            description="Project yang sudah dipublikasikan"
        />

        <x-stat-card
            title="Project Draft"
            :value="$draftProjects"
            description="Project yang masih berupa draft"
        />

        <x-stat-card
            title="Project Terbaru"
            :value="$latestProjects->count()"
            description="Lima project terbaru"
        />

    </div>

    {{-- KATEGORI DAN SKILL --}}
    <div class="dashboard-grid">

        {{-- PROJECT PER KATEGORI --}}
        <div class="dashboard-section">

            <h2>Project per Kategori</h2>

            @forelse ($categories as $category)

                <div class="category-item">
                    <span class="item-name">
                        {{ $category->name }}
                    </span>

                    <span class="item-count">
                        {{ $category->projects_count }} Project
                    </span>
                </div>

            @empty

                <p class="empty-project">
                    Belum ada kategori.
                </p>

            @endforelse

        </div>

        {{-- SKILL TERATAS --}}
        <div class="dashboard-section">

            <h2>Skill Teratas</h2>

            @forelse ($topSkills as $skill)

                <div class="skill-item">

                    <span class="item-name">
                        {{ $skill->name }}
                    </span>

                    <div class="skill-actions">

                        <span class="item-count">
                            {{ $skill->projects_count }} Project
                        </span>

                        <a
                            href="{{ route('skills.edit', $skill->id) }}"
                            class="skill-edit"
                        >
                            Edit
                        </a>

                    </div>

                </div>

            @empty

                <p class="empty-project">
                    Belum ada skill yang digunakan.
                </p>

            @endforelse

        </div>

    </div>

    {{-- PROJECT TERBARU --}}
    <div class="dashboard-section">

        <h2>Project Terbaru</h2>

        @forelse ($latestProjects as $project)

            <div class="project-item">

                <div>
                    <h3>{{ $project->title }}</h3>

                    <p>
                        Dibuat pada:
                        {{ $project->created_at->format('d M Y') }}
                    </p>

                    <p>
                        Status:
                        {{ ucfirst($project->status) }}
                    </p>

                    <span class="project-category">
                        {{ $project->category->name ?? 'Tanpa Kategori' }}
                    </span>
                </div>

                <a
                    href="{{ route('projects.show', $project->id) }}"
                    class="dashboard-link"
                >
                    Lihat Project →
                </a>

            </div>

        @empty

            <p class="empty-project">
                Belum ada project yang ditambahkan.
            </p>

        @endforelse

        <a
            href="{{ route('projects.index') }}"
            class="dashboard-link"
        >
            Lihat Semua Project →
        </a>

    </div>

</div>

@endsection
