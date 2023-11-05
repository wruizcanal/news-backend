<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gallery extends Model
{
    use HasFactory;

    /**
     * The multimedias that belong to the gallery.
     */
    public function multimedias(): BelongsToMany
    {
        return $this->belongsToMany(Multimedia::class, 'galleries_multimedias');
    }

}
