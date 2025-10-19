<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage; // ⬅ NEW

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'genre', 'release_year', 'description', 'cover_path']; // ⬅ add cover_path
    protected $appends = ['cover_url']; // ⬅ so we can use $game->cover_url in views

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function scopeSearch($q, ?string $term)
    {
        if ($term) $q->where('title', 'like', "%{$term}%");
        return $q;
    }

    // Optional: average rating helper
    public function avgRating(): ?float
    {
        if ($this->relationLoaded('reviews') && $this->reviews->count()) {
            return round($this->reviews->avg('rating'), 1);
        }
        return null;
    }

    
    // ⬅ NEW: computed URL for the image (or null)
    public function getCoverUrlAttribute(): ?string
    {
        return $this->cover_path ? Storage::url($this->cover_path) : null;
    }
}
