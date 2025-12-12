<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class FavoriteController extends Controller
{
    //  عرض المقالات المفضلة
    public function index()
    {
        $favorites = auth()->user()->favorites()->latest()->get();
        return view('users.blogs.favorites', compact('favorites'));
    }

    //  إضافة أو إزالة من المفضلة
    public function toggle(Blog $blog)
    {
        $user = auth()->user();

        if ($user->favorites->contains($blog->id)) {
            $user->favorites()->detach($blog->id);
            return back();
        } else {
            $user->favorites()->attach($blog->id);
            return back();
        }
    }
}