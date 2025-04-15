<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\Product;
use App\Models\ProductCart;
use Illuminate\Http\Request;

class ProductCartController extends Controller
{
    //

    public function CartList(Request $request)
    {
        $user_id = $request->header('id');
        $data = ProductCart::where('user_id', $user_id)->with('product')->get();
        return ResponseHelper::Out('success', $data, 200);
    }

    public function CreateCartList(Request $request)
    {
        $user_id = $request->header('id');
        $product_id = $request->input('product_id');
        $color = $request->input('color');
        $size = $request->input('size');
        $qty = $request->input('qty');
        $unitPrice = 0;

        $productDetails = Product::where('id', '=', $product_id)->first();
        if ($productDetails->discount == 1) {
            $unitPrice = $productDetails->discount_price;
        } else {
            $unitPrice = $productDetails->price;
        }
        $totalPrice = $qty * $unitPrice;

        $data = ProductCart::updateOrCreate(
            ['user_id' => $user_id, 'product_id' => $product_id],
            [
                'user_id' => $user_id,
                'product_id' => $product_id,
                'color' => $color,
                'size' => $size,
                'qty' => $qty,
                'price' => $totalPrice
            ]
        );

        return ResponseHelper::Out('success', $data, 200);
    }


    public function DeleteCartList(Request $request)
    {
        $user_id = $request->header('id');
        $product_id = $request->product_id;
        $data = ProductCart::where('user_id' , '=', $user_id)->where('product_id', '=', $product_id)->delete();
        return ResponseHelper::Out('success', $data, 200);
    }
}
