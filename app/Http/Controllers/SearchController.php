<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $s = $request->s;
        $posts = Post::like($s)->orderBy('id', 'desc')->with('category')->paginate(3);
        // %% - ищем по вхождению букв в строке
        return view('posts.search', compact('posts', 's'));
    }
}
