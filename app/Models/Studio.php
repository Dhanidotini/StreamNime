<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Studio extends Model
{
    protected $fillable = [
        'id',
        'name',
        'synonyms',
        'native',
        'desription',
        'slug',
    ];

    // Belongs to many Anime tables
    public function animes(): BelongsToMany
    {
        return $this->belongsToMany(Anime::class);
    }
}
