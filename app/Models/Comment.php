<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['commentable_id', 'commentable_type', 'points', 'comment_id', 'user_id', 'movie_id', 'comment', 'status', 'spoiler'];



    protected $casts = [
      'spoiler' => 'boolean',
      'status' => 'integer',
      'points' => 'integer'
    ];
    public function commentable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

}
