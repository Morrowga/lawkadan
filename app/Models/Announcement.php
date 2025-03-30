<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $table = 'announcements';

    protected $fillable = ['title', 'description', 'start_date', 'end_date', 'city_id'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
