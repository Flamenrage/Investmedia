<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function show($slug)
    {
        $tag = Tag::query()->where('slug', $slug)->firstOrFail(); //если не найдет - ошибка 404
        $posts = $tag->posts()->with('category')->orderBy('id', 'desc')->paginate(3);
        return view('tags.show', compact('tag', 'posts'));
    }
}
