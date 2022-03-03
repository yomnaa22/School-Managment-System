<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class PaymentController extends Controller
{
    // public function retrievePaymentRecord(Request $request)
    // {   //Just in case you need to query stripe to confirm from your server if a payment intent has made a successful payment or not
    //     $intent_id = $request->intent_id;
    //     \Stripe\Stripe::setApiKey(config('app.stripekey'));
    //     $event = \Stripe\PaymentIntent::retrieve($intent_id);
    // }
    //Create payment intent
    public function CreatePayIntent(Request $request)
    {
        \Log::info($request->all());
        try {
            $itemId = $request->id;
            $itemName = $request->name;
            $itemPrice = $request->price;
            $itemDescription = $request->description;
            $itemCurrency = strtolower($request->currency);
            $buyerEmail = $request->email;

            \Stripe\Stripe::setApiKey(config('app.stripekey'));

            $intent = \Stripe\PaymentIntent::create([
                'amount' => round($itemPrice * 100),
                'currency' => $itemCurrency,
                'description' => '('.$itemName.')'.' '.$itemDescription
            ]);

            return response(['intent' => $intent]);
        } catch (Exception $e) {
            return response()->json([
                'errors' => $e->getMessage()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function storeStripePayment(Request $request)
    {

        // dd($request);
        \Log::info($request->all());

        try {
            $intentId = $request->intentId;
            $itemId = $request->itemId;
            $paymentOption = 'stripe';
            $currency = $request->currency;
            $itemPrice = $request->itemPrice;
            $buyerEmail = $request->buyerEmail;
            $itemDescription = $request->itemDescription;

            $payment = Payment::create(
                [
                'intent_id' => $intentId,
                'item_id' => $itemId,
                'payment_option' => $paymentOption,
                'currency' => $currency,
                'item_price' => $itemPrice,
                'buyer_email' => $buyerEmail,
                'item_description' => $itemDescription,
                'payment_completed' => true
                ]
            );

            return response(['payment' => $payment]);

        } catch (Exception $e) {
            return response()->json([
                'errors' => $e->getMessage()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

}
