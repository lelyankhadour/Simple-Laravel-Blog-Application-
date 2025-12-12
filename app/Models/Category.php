<?php

namespace App\Models;
use App\Models\Blog;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = ['name'];
    //many to many relationship with blog
     public function Blogs(){
       return $this->belongsToMany(Blog::class);
    }
}
