<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title' , 'content' , 'user_id'];

    public function author()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function lastComment()
    {
        return $this->hasOne(Comment::class)->latest();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
