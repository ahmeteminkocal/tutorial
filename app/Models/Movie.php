<?php

namespace App\Models;

use App\Models\info\Country;
use App\Models\info\Director;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['name', 'description', 'director', 'country_id', 'release_date'];
    protected $casts = ['release_date' => 'date'];

    protected $appends = ['averagePoints'];
    protected $with = ['director', 'country', 'episodes'];
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class, 'movie_id');
    }
    public function director()
    {
        return $this->belongsTo(Director::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
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
