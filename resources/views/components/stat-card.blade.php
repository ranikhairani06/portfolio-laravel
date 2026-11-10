@props([
    'title',
    'value',
    'description' => null
])

<div class="stat-card">
    <p>{{ $title }}</p>
    <h2>{{ $value }}</h2>

    @if ($description)
        <small>{{ $description }}</small>
    @endif
</div>
