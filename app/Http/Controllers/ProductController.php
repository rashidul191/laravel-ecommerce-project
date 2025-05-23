<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\CustomerProfile;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductReview;
use App\Models\ProductSlider;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    // View Product Create Form Method
    public function index()
    {
        return view('backend.add-product-form');
    }

    // Product Create Method
    public function productCreate(Request $request)
    {

        // dd($request->all());
        $img = $request->file('image');

        $t = time();
        $img = $request->file('image');
        $getImgName = $img->getClientOriginalName();
        $newCreateImgName = "{$t}-{$getImgName}";
        $img->move(public_path('uploads'), $newCreateImgName);

        $img_url = "uploads/{$newCreateImgName}";
        // dd($img_url);

        Product::create([
            'title' => $request->input('title'),
            'short_des' => $request->input('short_des'),
            'price' => $request->input('price'),
            'discount' => $request->input('discount'),
            'discount_price' => $request->input('discount_price'),
            'stock' => $request->input('stock'),
            'star' => $request->input('star'),
            'remark' => $request->input('remark'),
            'category_id' => $request->input('category_id'),
            'brand_id' => $request->input('brand_id'),
            'image' => $img_url,
        ]);
        return redirect()->route('admin.index')->with('success', 'successfully product create');
    }


    public function ListProductByCategory(Request $request)
    {
        $data = Product::where('category_id', $request->id)->with('brand', 'category')->get();
        return ResponseHelper::Out('success', $data, 200);
    }

    public function ListProductByBrand(Request $request)
    {
        $data = Product::where('brand_id', $request->id)->with('brand', 'category')->get();
        return ResponseHelper::Out('success', $data, 200);
    }

    public function ListProductByRemark(Request $request)
    {
        $data = Product::where('remark', $request->remark)->with('brand', 'category')->get();


        return ResponseHelper::Out('success', $data, 200);
    }

    public function ListProductSlider(Request $request)
    {
        $data = ProductSlider::all();
        return ResponseHelper::Out('success', $data, 200);
    }

    public function ProductDetails()
    {
        return view('pages.single-product');
    }

    public function ProductDetailsById(Request $request)
    {
        $data = ProductDetail::where('product_id', '=', $request->id)->with('product', 'product.brand', 'product.category')->get();
        return ResponseHelper::Out('success', $data, 200);
    }

    public function ListReviewByProduct(Request $request)
    {
        // dd($request);
        $data = ProductReview::where('product_id', $request->product_id)
            ->with(['profile' => function ($query) {
                $query->select('id', 'cus_name');
            }])->get();

        return ResponseHelper::Out('success', $data, 200);
    }

    public function CreateProductReview(Request $request)
    {
        $user_id = $request->header('id');
        $profile = CustomerProfile::where('user_id', '=', $user_id)->first();
        if ($profile) {
            $request->merge(['customer_id' => $profile->id]);

            $data = ProductReview::updateOrCreate(
                ['customer_id' => $profile->id,  'product_id' => $request->input('product_id')],
                $request->input()
            );
            return ResponseHelper::Out('success', $data, 200);
        } else {
            return ResponseHelper::Out('fail', 'Customer profile not exists', 200);
        }
    }
}
