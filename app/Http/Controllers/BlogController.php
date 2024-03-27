<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::paginate(25);

        return view('pages.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('pages.blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'title' => 'required',
            'body' => 'required'
        ]);

        $image_name = time() . '.' . $request->image->extension();

        $request->image->move(public_path('images/blogs'), $image_name);


        Blog::create([
            'image' => 'public/images/blogs/' . $image_name,
            'title' => $request->title,
            'body' => $request->body
        ]);

        return redirect()->route('show blogs')->with('success', 'تم اضافة المدونة بنجاح');
    }

    public function edit(Blog $blog)
    {
        return view('pages.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        if (!empty($request->image)) {
            $image_name = time() . '.' . $request->image->extension();

            $request->image->move(public_path('images/blogs'), $image_name);
            $blog->update(['image' => 'public/images/blogs/' . $image_name]);
        }

        $blog->update([
            'title' => $request->title,
            'body' => $request->body
        ]);

        return redirect()->route('show blogs')->with('success', 'تم تعديل المدونة بنجاح');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('show blogs')->with('success', 'تم ازالة المدونة بنجاح');
    }

    public function get_blogs()
    {
        $blogs = Blog::latest()->get();

        return response()->json([
            'status' => 'success',
            'blogs' => $blogs
        ]);
    }

    public function get_blog(Blog $blog)
    {

        return response()->json([
            'status' => 'success',
            'blog' => $blog
        ]);
    }
}
