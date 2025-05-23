<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Helper\SSLCommerz;
use App\Models\CustomerProfile;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\ProductCart;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    //

    public function InvoiceCreate(Request $request)
    {
        DB::beginTransaction();
        try {

        $user_id = $request->header('id');
        $user_email = $request->header('email');

        $tran_id = uniqid();
        $delivery_status = 'Pending';
        $payment_status = 'Pending';

        $Profile = CustomerProfile::where('user_id', '=', $user_id)->first();
        $cus_details = "Name: $Profile->cus_name, Address:$Profile->cus_address, City:$Profile->cus_city, Phone:$Profile->cus_phone";
        $ship_details = "Name: $Profile->ship_name, Address:$Profile->ship_address, City:$Profile->ship_city, Phone:$Profile->ship_phone";

        // dd($Profile);

        // Payable Calculation
        // $total = ProductCart::where('user_id', '=', $user_id)->sum('price');

        $total = 0;
        $cartLists = ProductCart::where('user_id', '=', $user_id)->get();
        foreach ($cartLists as $cartItem) {
            $total += $cartItem->price;
        }

        $vat = ($total * 3) / 100; // supposed vat will be 3%
        $payable = $total + $vat;

        $invoice = Invoice::create([
            'total' => $total,
            'vat' => $vat,
            'payable' => $payable,
            'cus_details' => $cus_details,
            'ship_details' => $ship_details,
            'tran_id' => $tran_id,
            'delivery_status' => $delivery_status,
            'payment_status' => $payment_status,
            'user_id' => $user_id
        ]);

        $invoiceID = $invoice->id;

        foreach ($cartLists as $EachProduct) {

            InvoiceProduct::create([
                'invoice_id' => $invoiceID,
                'product_id' => $EachProduct->product_id,
                'user_id' => $user_id,
                'qty' => $EachProduct->qty,
                'sale_price' => $EachProduct->price
            ]);
        }
        $shippingMethod = "YES";
        $paymentMethod = SSLCommerz::InitiatePayment($Profile, $payable, $tran_id, $user_email, $shippingMethod);

        // dd($paymentMethod);
        DB::commit();

        return ResponseHelper::Out('success', array(['paymentMethod' => $paymentMethod, 'payable' => $payable, 'vat' => $vat, 'total' => $total]), 200);
        } catch (Exception $e) {
        DB::rollBack();
        return ResponseHelper::Out('fail', $e, 200);
        }
    }
}
