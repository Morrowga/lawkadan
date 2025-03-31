<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'posts';

    protected $fillable = ['title','phone_one', 'phone_two', 'description','help_count','remark', 'uuid','user_id', 'category_id', 'city_id', 'avg_persons', 'status', 'level'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        $media = $this->getFirstMedia('posts');
        return $media ? $media->getUrl() : null;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function helpers()
    {
        return $this->belongsToMany(User::class, 'post_helps')->withTimestamps();
    }
}
