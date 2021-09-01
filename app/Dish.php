<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Dish extends Model
{
    protected $table = 'dishes';


    protected $fillable = ['user_id', 'name', 'type', 'description', 'ingredients', 'img', 'price', 'visibility'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }
}
