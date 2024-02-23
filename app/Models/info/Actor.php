<?php

namespace App\Models\info;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $fillable = ['picture', 'name', 'birth_date'];

    protected $casts = [
        'birth_date' => 'date'
    ];

    public function movie(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Movie::class);
    }
}
