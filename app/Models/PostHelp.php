<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostHelp extends Model
{
    use HasFactory;

    protected $table = 'post_helps';

    protected $fillable = ['post_id', 'user_id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
