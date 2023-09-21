<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;

class StripeController extends Controller
{
    public function payment(Request $request){
        \Stripe\Stripe::setApikey(config('stripe.sk'));
        $response = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data'=> [
                        'currency'=>'usd',
                        'product_data'=> [
                            'name'=>"gimme moneeey!!!" ,
                        ],
                        'unit_amount'=> $request->price *100,
                    ],
                    'quantity'=> $request->quantity ,
                ],
            ],
            'mode'=>'payment',
            'success_url'=>route('stripe.success'),
            'cancel_url' =>route('stripe.cancel'),
        ]);
        return redirect($response->url);
    }
    
    public function success(Request $request){
        
    }
    
    public function cancel(Request $request){
        
    }
}
