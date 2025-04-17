<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductSlider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function HomePage()
    {


        $categories = Category::all();
        $brands = Brand::all();
        $heroSliders = ProductSlider::all();
        // dd($categories);
        return view('pages.home-page', compact('heroSliders','categories', 'brands'));
    }
}
