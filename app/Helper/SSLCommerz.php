<?php

namespace App\Helper;

use App\Models\SslcommerzAccount;
use Exception;
use Illuminate\Support\Facades\Http;

class SSLCommerz
{

    static function InitiatePayment($Profile, $payable, $tran_id, $user_email, $shippingMethod)
    {
        try {
            $ssl = SslcommerzAccount::first();
          

            // $response = Http::asForm()->post($ssl->init_url, [
            //     'store_id' => $ssl->store_id,
            //     'store_passwd' => $ssl->store_passwd,
            //     'total_amount' => $payable,
            //     'currency' => $ssl->currency,
            //     'tran_id' => $tran_id,
            //     'success_url' => "$ssl->success_url?tran_id=$tran_id",
            //     'fail_url' => "$ssl->fail_url?tran_id=$tran_id",
            //     'cancel_url' => "$ssl->cancel_url?tran_id=$tran_id",
            //     'ipn_url' => $ssl->ipn_url,
            //     'cus_name' => $Profile->cus_name,
            //     'cus_email' => $user_email,
            //     'cus_add1' => $Profile->cus_address,
            //     'cus_add2' => $Profile->cus_address,
            //     'cus_city' => $Profile->cus_city,
            //     'cus_state' => $Profile->cus_city,
            //     'cus_postcode' => '1216',
            //     'cus_country' => $Profile->cus_country,
            //     'cus_phone' => $Profile->cus_phone,
            //     'cus_fax' => $Profile->cus_phone,
            //     'shipping_method' => $shippingMethod,
            //     'ship_name' => $Profile->ship_name,
            //     'ship_add1' => $Profile->ship_address,
            //     'ship_add2' => $Profile->ship_address,
            //     'ship_city' => $Profile->ship_city,
            //     'ship_state' => $Profile->ship_city,
            //     'ship_postcode' => '1216',
            //     'ship_country' => $Profile->ship_country,
            //     // multi_card_name=mastercard,visacard,amexcard&
            //     // value_a=ref001_A&
            //     // value_b=ref002_B&
            //     // value_c=ref003_C&
            //     // value_d=ref004_D'
            //     'product_name' => 'Apple Shop Product',
            //     'product_category' => 'Apple Shop Category',
            //     'product_profile' => 'Apple Shop Profile',
            //     'product_amount' => $payable
            // ]);

            $response = Http::asForm()->post($ssl->init_url,[
                "store_id"=>$ssl->store_id,
                "store_passwd"=>$ssl->store_passwd,
                "total_amount"=>$payable,
                "currency"=>$ssl->currency,
                "tran_id"=>$tran_id,
                "success_url"=>"$ssl->success_url?tran_id=$tran_id",
                "fail_url"=>"$ssl->fail_url?tran_id=$tran_id",
                "cancel_url"=>"$ssl->cancel_url?tran_id=$tran_id",
                "ipn_url"=>$ssl->ipn_url,
                "cus_name"=>$Profile->cus_name,
                "cus_email"=>$user_email,
                "cus_add1"=>$Profile->cus_add,
                "cus_add2"=>$Profile->cus_add,
                "cus_city"=>$Profile->cus_city,
                "cus_state"=>$Profile->cus_city,
                "cus_postcode"=>"1216",
                "cus_country"=>$Profile->cus_country,
                "cus_phone"=>$Profile->cus_phone,
                "cus_fax"=>$Profile->cus_phone,
                "shipping_method"=>$shippingMethod,
                "ship_name"=>$Profile->ship_name,
                "ship_add1"=>$Profile->ship_add,
                "ship_add2"=>$Profile->ship_add,
                "ship_city"=>$Profile->ship_city,
                "ship_state"=>$Profile->ship_city,
                "ship_country"=>$Profile->ship_country ,
                "ship_postcode"=>"1216",
                "product_name"=>"Apple Shop Product",
                "product_category"=>"Apple Shop Category",
                "product_profile"=>"Apple Shop Profile",
                "product_amount"=>$payable,
            ]);


            // dd($response);
            return $response->json('desc');
            // return $response->json()['GatewayPageURL'] ?? null;
        } catch (Exception $e) {

            return $ssl;
        }
    }
}
