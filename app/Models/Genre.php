<?php

namespace App\Models;

use App\Models\Anime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    public function animes(): BelongsToMany
    {
        return $this->belongsToMany(Anime::class);
    }
}
