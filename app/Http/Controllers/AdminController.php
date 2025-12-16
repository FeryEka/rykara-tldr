<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $categories = Category::latest();;

        return view('admin-dashboard.index', ['categories' => $categories->paginate(5)->withquerystring()]);
    }


}
