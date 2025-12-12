<?php

namespace App\Models;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{use SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'image',];
    //many to many relationship with category
    public function categories(){
      return  $this->belongsToMany(Category::class);
    }    
    //many to many relationship with user 
    public function favoredBy()
{
    return $this->belongsToMany(User::class, 'blog_user')->withTimestamps();
}
}
