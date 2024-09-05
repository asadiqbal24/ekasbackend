<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::paginate(6);
        return view('blog.index', compact('blogs'));
    }
    public function details($id)
    {
        $blog = Blog::with('blogCategory')->findOrFail($id);
        return view('blog.details', compact('blog'));
    }
    public function catBlogs($id)
    {
        $categoryName = BlogCategory::find($id);
        $blogs = Blog::where('category', $id)->paginate(1);
        return view('blog.cat-blogs', compact('blogs' , 'id' , 'categoryName'));
    }
    public function loadMoreBlogs(Request $request)
    {
        if ($request->ajax()) {
            $page = $request->get('page');
            $blogs = Blog::paginate(1, ['*'], 'page', $page);
            return view('blog.partials.blogs', compact('blogs'))->render();
        }
    }
    public function loadMoreCatBlogs(Request $request)
    {
        if ($request->ajax()) {
            $page = $request->get('page', 1);
            $categoryId = $request->get('category_id');
            $blogs = Blog::where('category', $categoryId)->paginate(1, ['*'], 'page', $page);
            return view('blog.partials.blogs', compact('blogs'))->render();
        }
    }
}
