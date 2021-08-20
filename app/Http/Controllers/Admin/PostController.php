<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;


class PostController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all(); //value, key
        $posts = Post::with('category', 'tags')->withCount('comments')->orderBy('comments_count', 'desc')->paginate(20);
        return view('admin.posts.index',compact('posts', 'categories'));
    }

    public function sortByCategory($name)
    {
        $categories = Category::all(); //value, key
        $category = Category::query()->where('slug', $name)->firstOrFail(); //если не найдет - ошибка 404
        $posts = $category->posts()->orderBy('id', 'desc')->paginate(10);
        return view('admin.posts.index',compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::query()->pluck('title', 'id'); //value, key
        $tags = Tag::query()->pluck('title', 'id');
        return view('admin.posts.create',compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'category_id' => 'required|integer',
            'thumbnail' => 'nullable|image'
        ]);

        $data = $request->all();
        if ($request->hasFile('thumbnail')) {
            $folder = date('Y-m-d'); //2021-06-20 и тд
            $data['thumbnail'] = $request->file('thumbnail')->store("images/${folder}", 'public'); //сохранит картинку в папку app/public/images/папка с именем под случайным именем
        }
        $post = Post::query()->create($data);
        $post->tags()->sync($request->tags); // сохраняет новые данные и удаляет старые по ключу
        //image, хранение - для этогоо идем в config, filesystems, меняем в disks storage_path на
        // public_path, чтобы сохранялось в папку public, 40 строка
        //16 строка там же - public, было local
       /* Post::query()->create($request->all());*/
        $request->session()->flash('success', 'Данные добавлены');
        return redirect()->route('posts.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();
        //App::make('files')->link(storage_path('app/public'), public_path('storage'));
        return view('admin.posts.edit', compact('categories', 'tags', 'post'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'category_id' => 'required|integer',
            'thumbnail' => 'nullable|image'
        ]);
        $post = Post::query()->find($id);
        $post->slug = null; // автоматически формирует новый slug
        $data = $request->all();
        if ($request->thumbnail){
            $folder = date('Y-m-d'); //2021-06-20 и тд
            $data['thumbnail'] = $request->file('thumbnail')->store("images/${folder}", 'public'); //сохранит картинку в папку app/public/images/папка с именем под случайным именем
        }
        $post->update($data);
        $post->tags()->sync($request->tags); // сохраняет новые данные и удаляет старые по ключу
        $request->session()->flash('success', 'Данные обновлены');
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::query()->find($id);
        if ($post) {
            $post->tags()->sync([]); //удаляем связанные данные
            Storage::delete($post->thumbnail);
            $post->delete();
        }
        return redirect()->route('posts.index')->with('success', 'Данные удалены');
    }

}
