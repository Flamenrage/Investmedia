<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;


class TagController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::query()->withCount('posts')->orderBy('posts_count', 'desc')->paginate(20);
        return view('admin.tags.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
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
            'title' => 'required'
        ]);
        Tag::query()->create($request->all());
        $request->session()->flash('success', 'Данные добавлены');
        return redirect()->route('tags.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::query()->find($id);
        return view('admin.tags.edit',compact('tag'));

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
            'title' => 'required'
        ]);
        $tag = Tag::query()->find($id);
        $tag->slug = null; // автоматически формирует новый slug
        $tag->update($request->all());
        $request->session()->flash('success', 'Данные обновлены');
        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::query()->find($id);
        if ($tag->posts->count()) { //если есть посты у категории
            return redirect()->route('tags.index')->with('error', 'У тега есть посты');
        }
        else if ($tag) {
            $tag->delete();
        }
        return redirect()->route('tags.index')->with('success', 'Данные удалены');
    }

}
