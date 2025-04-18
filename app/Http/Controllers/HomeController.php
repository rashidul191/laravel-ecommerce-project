<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
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
        $productQueries = Product::get();
        $productTabs = $productQueries->unique('remark');
        $featureProducts = $productQueries->where('remark', '=','featured');
        // dd($featureProducts);
        return view('pages.home-page', compact('heroSliders', 'categories', 'brands', 'productTabs', 'productQueries', 'featureProducts'));
    }
}
