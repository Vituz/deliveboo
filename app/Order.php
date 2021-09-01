<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{

    public function dishes(): BelongsToMany
    {
        return $this->belongsToMany(Dish::class);
    }
}
