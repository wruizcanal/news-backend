<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Gallery extends Model
{
    use HasFactory, Sluggable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * The multimedias that belong to the gallery.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function multimedias(): BelongsToMany
    {
        return $this->belongsToMany(Multimedia::class, 'galleries_multimedias');
    }

}
