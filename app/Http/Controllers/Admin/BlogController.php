<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('content.blogs.index', compact('blogs'));
    }
    public function create()
    {
        $heading = 'Add Blog';
        $sub_heading = 'You can add a new blog';
        $categories = BlogCategory::all();
        return view('content.blogs.add', compact('categories', 'heading', 'sub_heading'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image',
            'description' => 'required',
        ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $data['image'] = $path;
        }
        $data['authorname'] = Auth::user()->fname . ' ' . Auth::user()->lname;
        Blog::create($data);
        return redirect()->back()->with('message', 'blog created successfully');
    }
    public function edit($id)
    {
        $heading = 'Edit Blog';
        $sub_heading = 'You can edit a new blog';
        $blog = Blog::find($id);
        $categories = BlogCategory::all();
        return view('content.blogs.edit', compact('blog', 'heading', 'sub_heading', 'categories'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $data['image'] = $path;
        }
        $data['authorname'] = Auth::user()->fname . ' ' . Auth::user()->lname;
        $blog = Blog::find($id);
        $blog->update($data);
        return redirect()->back()->with('message', 'blog updated successfully');
    }
    public function delete($id)
    {
        Blog::find($id)->delete();
        return redirect()->back()->with('message', 'blog deleted successfully');
    }
}
