<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'thumbnail',
        'status',
        'category_id',
    ];

    // Scope untuk mengambil project yang sudah dipublikasikan
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    // Relasi project dengan gallery
    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class)
            ->orderBy('sort_order');
    }

    // Relasi project dengan kategori
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi project dengan skill
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class)
            ->withTimestamps();
    }
}
