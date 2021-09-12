<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CategoryUsers extends Model
{
    // public function users(): BelongsToMany
    // {
    //     return $this->belongsToMany(User::class);
    // }

    // public function categories(): BelongsToMany
    // {
    //     return $this->belongsToMany(Category::class);
    // }
}
