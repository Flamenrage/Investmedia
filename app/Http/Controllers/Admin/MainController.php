<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use App\Models\Tag;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MainController extends Controller
{



    public function index()
    {
        $data = [];
        $categories = Category::query()->withCount('posts')->orderBy('posts_count', 'desc')->get();
        for ($i = 0; $i < count($categories); $i++)
        {
            $data[$i] = $categories[$i]->posts_count;
        }
        $ChartData = ['cats' => $categories->pluck('title'), 'data' => $data];
        return view('admin.index',['cats' => $categories->pluck('title'), 'data' => $data, 'ChartData' => $ChartData ]);
    }
}
