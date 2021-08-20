<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->orderBy('id', 'desc')->paginate(3);
        return view('posts.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::query()->where('slug', $slug)->firstOrFail(); //если не найдет - ошибка 404
        $post->views += 1;
        $post->update();
        $comments = $post->comments()->orderBy('id', 'desc')->paginate(10);
        return view('posts.show', compact('post', 'comments'));
    }


}
