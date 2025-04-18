<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function CategoryPage()
    {
        // return "hi";
        return view('pages.category-page');
    }

    public function CategoryList()
    {
        $data = Category::all();
        return ResponseHelper::Out("success", $data, 200);
    }
}
