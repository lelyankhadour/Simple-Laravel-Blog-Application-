<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Blog;
use Illuminate\Http\Request;

class UserBlogController extends Controller
{
    //عرض كل المقالات
    public function index()
    {
        $blogs = Blog::latest()->get(); 
        return view('users.blogs.index', compact('blogs'));
    }
public function afterFilter(Request $request)
{
    $blogs = Blog::with('categories');

    // إذا المستخدم اختار كاتيغوريز
    if ($request->has('categories')) {
        $selected = $request->input('categories'); // array of selected category IDs
       // $selected = array( $request->categories); // convert to array
//جلب الحقول التي لها علاقة بالفئة المختارة
        $blogs = $blogs->whereHas('categories', function ($query) use ($selected) {
            $query->whereIn('categories.id', $selected);
        });
    }

    $blogs = $blogs->latest()->get(); 
    $categories = Category::all();

    return view('users.blogs.index', compact('blogs', 'categories'));
}//عرض تفاصيل 
    public function show($id)
    {
        $blog = Blog::findOrFail($id);

        // إذا المستخدم مسجل دخول، نتحقق إذا المقال مضاف للمفضلة
        $isFavorite = false;
        if (auth()->check()) {
            $isFavorite = auth()->user()->favorites->contains($blog->id);
        }

        return view('users.blogs.show', compact('blog', 'isFavorite'));
    }
}