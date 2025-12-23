<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest();
        return view('admin.categories.index', ['categories' => $categories->paginate(5)->withquerystring()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|unique:categories,name|min:2|max:60',
            'color' => 'required',
        ], [
            'name.required' => ':attribute ini harus diisi.',
            'name.unique' => ':attribute sudah ada, silahkan gunakan judul lain.',
            'name.min' => ':attribute minimal :min karakter.',
            'name.max' => ':attribute maksimal :max karakter.',
            'color.required' => ':attribute ini harus diisi.',
        ],[
            'name' => 'Nama Category',
            'color' => 'Warna Category',
        ])->validate();

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'color' => $request->color,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
