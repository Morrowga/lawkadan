<?php

namespace App\Models;

use ThihaMorph\MyanMap\Eloquent\State as BaseState;
use Illuminate\Database\Eloquent\Model;

class State extends BaseState
{
    public function cities()
    {
        return $this->belongsToMany(City::class, 'state_city', 'state_id', 'city_id');
    }
}
