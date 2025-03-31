<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ThihaMorph\MyanMap\Eloquent\City as BaseCity;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends BaseCity
{
    protected $table = 'cities';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'city_id', 'id');
    }
}
