<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{

    public function show($slug)
    {
        $category = Category::query()->where('slug', $slug)->firstOrFail(); //если не найдет - ошибка 404
        $posts = $category->posts()->orderBy('id', 'desc')->paginate(3);
        return view('categories.show', compact('category', 'posts'));
    }
}
