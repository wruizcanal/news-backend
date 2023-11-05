<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Multimedia extends Model
{
    use HasFactory;

    protected $table = "multimedias";
    /**
     * Get the author that owns the multimedia.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Get the gallery that owns the multimedia.
     */
    public function gallery(): BelongsToMany
    {
        return $this->belongsToMany(Gallery::class,'galleries_multimedias');
    }

    /**
     * Get the news for the multimedia.
     */
    public function news(): HasMany
    {
        return $this->hasMany(News::class,'cover_picture');
    }
}
