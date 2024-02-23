<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    const STATUS_WAITING = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = -1;
    protected $fillable = [
        'episode_id', 'uploader_id', 'uploader_type', 'iframe',
    ];

    public function uploader(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function episode()
    {
        return $this->belongsTo(Episode::class);
    }

}
