<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function HomePage()
    {


        $categories = Category::all();
        $brands = Brand::all();
        // dd($categories);
        return view('pages.home-page', compact('categories', 'brands'));
    }
}
