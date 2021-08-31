<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dish extends Model
{
    protected $table='dishes'; 


    public function user(){
        return $this->belongsTo(User::class);
    }

}