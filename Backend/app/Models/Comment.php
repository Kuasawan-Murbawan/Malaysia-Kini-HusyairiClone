<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'body',
        'story_id'
    ];

    public function story(): BelongsTo{
        return $this->belongsTo(Story::class);
    }


}
