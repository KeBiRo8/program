<?php

namespace App\Http\Controllers;

use App\Models\Category;

class Categorycontroller extends Controller
{
    public function index(Category $category)
    {
        return view('categories.index')->with(['posts' => $category->getByCategory()]);
    }
}