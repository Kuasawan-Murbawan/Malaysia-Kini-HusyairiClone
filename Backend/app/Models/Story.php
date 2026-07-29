<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Story extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'category_id',
        'date_published',
        'comment_count',
        'language',
        'link',
        'summary',
        'author_id',
        'full_story',
    ];

    public function category():BelongsTo{
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo{
        return $this->belongsTo(Author::class);
    }

    public function tags(): BelongsToMany{
        return $this->belongsToMany(Tag::class);
    }

    public function comments(): HasMany{
        return $this->hasMany(Comment::class);
    }
}
