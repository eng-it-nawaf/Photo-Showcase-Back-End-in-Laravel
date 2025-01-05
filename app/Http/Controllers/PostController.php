<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\StorePostRequest;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category')->get();  // جلب المنشورات مع الفئات

        return view('posts.index', compact('posts'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();  // جلب كل الفئات

        return view('posts.create', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request) 
    public function store(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $validated = $request->validate([ 
            'title' => 'required|max:255',
            'text' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // تحقق من الصورة
        ]);
    
        // معالجة رفع الصورة إذا كانت موجودة
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            // $request->image->move(public_path("C:\xampp\htdocs\na_laravel_11\public\images"), $imageName);
            $validated['image'] = $imageName; // إضافة اسم الصورة إلى البيانات المدخلة
        }
    
        // إنشاء المنشور الجديد
        Post::create($validated);
    
        // إعادة التوجيه إلى صفحة عرض المنشورات مع رسالة نجاح
        return redirect()->route('posts.index')->with('success', 'تم إضافة المنشور بنجاح!');
    }
    
    






    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
 
        return view('posts.edit', compact('post', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'text' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // تحقق من الصورة
        ]);
    
        // معالجة رفع الصورة إذا كانت موجودة
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($post->image) {
                unlink(public_path('images') . '/' . $post->image);
            }
    
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validated['image'] = $imageName;
        }
    
        $post->update($validated);  // تحديث المنشور
    
        return redirect()->route('posts.index')->with('success', 'تم تحديث المنشور بنجاح!');
    }
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();  // حذف المنشور

        return redirect()->route('posts.index')->with('success', 'تم حذف المنشور بنجاح!');
    }
}

