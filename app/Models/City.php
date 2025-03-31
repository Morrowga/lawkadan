<?php

namespace App\Models;

use ThihaMorph\MyanMap\Eloquent\City as BaseCity;
use Illuminate\Database\Eloquent\Model;

class City extends BaseCity
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
