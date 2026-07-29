<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    // ensure user cant send request like {isAdmin: true}
    protected $fillable= [
        'name', 'description'
    ];

    // declared that for 1 Category, can have many Stories
    public function stories(): HasMany{
        return $this->hasMany(Story::class);
    }

}
