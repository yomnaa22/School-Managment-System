<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use Session;
class payment extends Controller
{
    //
    public function charge(Request $request) {

        // Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        // $charge=  Stripe\Charge::create ([
        //         "amount" => 100 * 100,
        //         "currency" => "usd",
        //         "source" => $request->stripeToken,
        //         "description" => "This payment is tested purpose phpcodingstuff.com"
        // ]);

        $charge= Stripe::charges()->create([
           'currency' => 'USD',
           'source' => $request->stripeToken,
           'amount' => 100 * 100,
           'desc' => 'Test from laravel new app',
        ]);
        $chargeId= $charge['id'];
        if($chargeId){
            //  session()->forget('cart');
             return response()->json('success',200);
        }else{
            return response()->json('failed', 404);
        }
    }

}




