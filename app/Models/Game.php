<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'genre', 'release_year', 'description'];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Simple search by title
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
}
