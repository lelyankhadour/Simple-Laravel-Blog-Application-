<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\BlogRequest;
use App\Http\Requests\BlogURequest;
//use App\Http\Controllers\BlogRequest;
class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }
    public function show(Blog $blog)
    {
        return view('admin.blogs.show', compact('blog'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.blogs.create', compact('categories'));
    }  
   public function store(BlogRequest $request)
{   //  Form Request
    $validated = $request->validated();
    // رفع الصورة وتخزين المسار
    $imagePath = $request->file('image')->store('blogs', 'public');
    // إنشاء 
    $blog = Blog::create([
        'title'   => $validated['title'],
        'content' => $validated['content'],
        'image'   => $imagePath,
    ]);
    // ربط الفئات إذا تم اختيارها
    if ($request->has('categories')) {
        $blog->categories()->attach($validated['categories']?? []);
    }
    return redirect()->route('blogs.index');
}
    public function edit(Blog $blog)
    {
        $categories = Category::all();
        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    // public function update(Request $request, Blog $blog)
    // {
    //     // $request->validate([
    //     //     'title'   => 'required|string|max:255',
    //     //     'content' => 'required|string',
    //     //     'image'   => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
    //     // ]);

    //     $blog->update([
    //         'title'   => $request->title,
    //         'content' => $request->content,
    //     ]);

    //     // تحديث الصورة
    //     if ($request->hasFile('image')) {
    //         // حذف الصورة القديمة
    //         if ($blog->image && Storage::disk('public')->exists($blog->image)) {
    //             Storage::disk('public')->delete($blog->image);
    //         }

    //         $imagePath = $request->file('image')->store('blogs', 'public');
    //         $blog->update(['image' => $imagePath]);
    //     }

    //     // تحديث الفئات
    //     $blog->categories()->sync($request->categories ?? []);

    //     return redirect()->route('blogs.index')->with('success', 'تم تحديث المدونة بنجاح');
    // }

public function update(BlogURequest $request, Blog $blog)
{
    $validated = $request->validated();

    // إذا المستخدم رفع صورة جديدة
    if ($request->hasFile('image')) {

        // حذف الصورة القديمة إذا موجودة
        if ($blog->image && \Storage::disk('public')->exists($blog->image)) {
            \Storage::disk('public')->delete($blog->image);
        }

        // رفع الصورة الجديدة
        $validated['image'] = $request->file('image')->store('blogs', 'public');
    }

    
    $blog->update($validated);

    // تحديث الفئات
    if ($request->has('categories')) {
        $blog->categories()->sync($request->categories);
    }

    return redirect()->route('blogs.index');
}
    public function destroy(Blog $blog)
    {
        $blog->delete(); // حذف ناعم (soft delete)
        return redirect()->route('blogs.index');
    }

    public function trashed()
    {
        $blogs = Blog::onlyTrashed()->latest()->get();
        return view('admin.blogs.trashed', compact('blogs'));
    }

    public function restore($id)
    {
        $blog = Blog::onlyTrashed()->findOrFail($id);
        $blog->restore();

        return redirect()->route('blogs.trashed')->with('success', 'restore is done   ');
    }

    public function forceDelete($id)
    {
        $blog = Blog::onlyTrashed()->findOrFail($id);

        // حذف الصورة من التخزين
        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->forceDelete();//حذف نها~ي

        return redirect()->route('blogs.trashed')->with('success', 'delete complete   ');
    }
    public function home()
{
    $blogs = Blog::withTrashed()->latest()->get(); // عرض كل المقالات حتى المحذوفة مؤقتًا
    return view('admin.home', compact('blogs'));
}
}
