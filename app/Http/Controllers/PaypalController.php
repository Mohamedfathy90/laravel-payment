<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class PaypalController extends Controller
{
    public function payment(Request $request){
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent"=> "CAPTURE",
            "application_context"=> [
                "return_url"=> route('paypal.success') ,
                "cancel_url"=> route('paypal.cancel') ,
            ],
            
            "purchase_units"=>[
              [
               "amount"=>[
                  "currency_code"=> "USD",
                  "value"=> $request->price*$request->quantity
                ]
                
              ]
           ]
        ]);

       
        if (isset($response['id'])){
            foreach($response['links'] as $link){
                if($link['rel'] === 'approve'){
                    return redirect()-> away($link['href']);
                    break;
                }
            }
        }

    }

    public function success(Request $request){
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        if (isset($response['status']) && $response['status']=='compeleted'){
            return "Paid Successfully!!" ;
        }
 
    }

    public function cancel(){
        
    }
}
