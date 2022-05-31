<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $s = $request->s;
        $posts = Post::like($s)->orderBy('id', 'desc')->with('category')->paginate(3);
        return view('posts.search', compact('posts', 's'));
    }
}
