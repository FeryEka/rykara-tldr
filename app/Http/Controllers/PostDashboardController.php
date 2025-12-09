<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->where('author_id', Auth::user()->id);
        if(request('keyword')){
            $posts->where('title', 'like', '%' . request('keyword') . '%');
        }
        
        return view('dashboard.index', ['posts' => $posts->paginate(5)->withquerystring()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
            'content' => 'required | min:255',
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

        // store to database
        Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'author_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'content' => $request->content,
        ]);

        return redirect('/dashboard')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/dashboard')->with('success', 'Post deleted successfully!');
    }
}
