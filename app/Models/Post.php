<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [ "title", "picture", "content" ];

    public static function boot(){
        parent::boot();
        self::creating(function ($post){
            $post->user()->associate(auth()->user()->id);
        });
    }

    public function isLikedByLoggedInUser() {
        return $this->likes->where('user_id', auth()->user()->id)->isEmpty() ? false : 
        true;
    }
    public function isDislikedByLoggedInUser() {
        return $this->dislikes->where('user_id', auth()->user()->id)->isEmpty() ? false : 
        true;
    }

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function dislikes()
    {
        return $this->hasMany(Dislike::class);
    }

}
