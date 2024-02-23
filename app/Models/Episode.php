<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{

    protected $fillable = ['movie_id', 'name', 'description'];

    protected $appends = ['averagePoints'];
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    protected function averagePoints(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => $this->getAvgPoints(),
            set: fn($value) => $value,
        );
    }
    public function getAvgPoints()
    {
        return $this->comments->avg('points') / 100 * 5;
    }
}
