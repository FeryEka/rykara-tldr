<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostDashboardController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->where('author_id', Auth::user()->id);
        if(request('keyword')){
            $posts->where('title', 'like', '%' . request('keyword') . '%');
        }
        
        return view('dashboard.index', ['posts' => $posts->paginate(5)->withquerystring()]);
    }

    public function create()
    {
        return view('dashboard.create');
    }

    public function store(Request $request, Post $post)
    {
        // // validate request using validate method
        // $request->validate([
        //     'title' => 'required',
        //     'category_id' => 'required',
        //     'content' => 'required',
        // ]);
        // validate request using validator facade
        Validator::make($request->all(), [
            'title' => 'required | unique:posts,title | min:5 | max:100',
            'category_id' => 'required',
            'content' => 'required | min:50',
        ], [
            'title.required' => ':attribute ini harus diisi.',
            'title.unique' => ':attribute sudah ada, silahkan gunakan judul lain.',
            'title.min' => ':attribute minimal :min karakter.',
            'title.max' => ':attribute maksimal :max karakter.',
            'category_id.required' => 'Pilih salah satu :attribute.',
            'content.required' => ':attribute tidak boleh kosong.',
            'content.min' => ':attribute minimal :min karakter.',
        ],[
            'title' => 'Judul Post',
            'category_id' => 'Kategori',
            'content' => 'Konten Artikel',
        ])->validate();

        $post->create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'author_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'content' => $request->content,
        ]);

        return redirect('/dashboard')->with('success', 'Post created successfully!');
    }

    public function show(Post $post)
    {
        return view('dashboard.show', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        return view('dashboard.edit', ['post' => $post]);
    }

    public function update(Request $request, Post $post)
    {
        Validator::make($request->all(), [
            'title' => 'required | min:5 | max:100 | unique:posts,title,' . $post->id,
            'category_id' => 'required',
            'content' => 'required | min:50',
        ], [
            'title.required' => ':attribute ini harus diisi.',
            'title.unique' => ':attribute sudah ada, silahkan gunakan judul lain.',
            'title.min' => ':attribute minimal :min karakter.',
            'title.max' => ':attribute maksimal :max karakter.',
            'category_id.required' => 'Pilih salah satu :attribute.',
            'content.required' => ':attribute tidak boleh kosong.',
            'content.min' => ':attribute minimal :min karakter.',
        ],[
            'title' => 'Judul Post',
            'category_id' => 'Kategori',
            'content' => 'Konten Artikel',
        ])->validate();

        $post->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'author_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'content' => $request->content,
        ]);

        return redirect('/dashboard')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/dashboard')->with('success', 'Post deleted successfully!');
    }
}
