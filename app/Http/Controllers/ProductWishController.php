<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\ProductWishe;
use Illuminate\Http\Request;

class ProductWishController extends Controller
{
    //
    public function ProductWishList(Request $request)
    {
        $user_id = $request->header('id');
        $data = ProductWishe::where('user_id', '=', $user_id)->with('product')->get();        
        return ResponseHelper::Out('success', $data, 200);
    }
    public function CreateWishList(Request $request)
    {
        $user_id = $request->header('id');
   
        $data = ProductWishe::updateOrCreate(
            ['user_id' => $user_id, 'product_id' => $request->product_id],
            ['user_id' => $user_id, 'product_id' => $request->product_id],
        );
        return ResponseHelper::Out('success', $data, 200);
    }

    public function RemoveWishList(Request $request)
    {
        $user_id = $request->header('id');
        $data = ProductWishe::where('user_id', '=', $user_id)->where('product_id', '=', $request->product_id)->delete();
        // $data = ProductWishe::where(['user_id' => $user_id, 'product_id' => $request->product_id])->delete();
        return ResponseHelper::Out('success', $data, 200);
    }
}
