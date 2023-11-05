<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    use HasFactory;

    /**
     * The multimedias that belong to the author.
     */
    public function multimedias(): BelongsToMany
    {
        return $this->belongsToMany(Multimedia::class, 'authors_multimedias');
    }

    /**
     * The news that belong to the author.
     */
    public function news(): BelongsToMany
    {
        return $this->belongsToMany(News::class, 'authors_news');
    }
}
