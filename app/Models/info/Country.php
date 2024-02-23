<?php

namespace App\Models\info;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];

}
