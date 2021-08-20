<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $s = $request->s;
        $posts = Post::like($s)->orderBy('id', 'desc')->with('category')->paginate(3);
        // %% - ищем по вхождению букв в строке
        return view('admin.posts.search', compact('posts', 's'));
    }
}
