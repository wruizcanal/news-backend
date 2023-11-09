<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    use HasFactory, Sluggable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'avatar',
        'fullname',
        'email',
        'details',
        'ocupation',
        'active',
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
                'source' => 'fullname'
            ]
        ];
    }

    /**
     * The multimedias that belong to the author.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function multimedias(): BelongsToMany
    {
        return $this->belongsToMany(Multimedia::class, 'authors_multimedias');
    }

    /**
     * The news that belong to the author.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function news(): BelongsToMany
    {
        return $this->belongsToMany(News::class, 'authors_news');
    }
}
