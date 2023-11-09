<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class News extends Model
{
    use HasFactory, Sluggable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'title',
        'summary',
        'content',
        'status',
        'open_close',
        'published_date',
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
                'source' => 'title'
            ]
        ];
    }

    /**
     * Get the category that owns the news.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the author that owns the news.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function author(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'authors_news', 'author_id');
    }

    /**
     * Get the coverPicture associated with the news.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function coverPicture(): BelongsTo
    {
        return $this->belongsTo(Multimedia::class, 'cover_picture', 'id');
    }
}
