<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class News extends Model
{
    use HasFactory;

    /**
     * Get the category that owns the news.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /*
    * Get the author that owns the news.
    */
   public function author(): BelongsToMany
   {
       return $this->belongsToMany(Author::class, 'authors_news','author_id');
   }

    /**
     * Get the coverPicture associated with the news.
     */
    public function coverPicture(): BelongsTo
    {
        return $this->belongsTo(Multimedia::class, 'cover_picture', 'id');
    }
}
