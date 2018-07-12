<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use App\Order;

use Stripe;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\PaymentRequest $request, Order $order)
    {
        // Forbid action if order already complete
        if($order->completed == true) {
            abort(403);
        }

        // add up products in the order to calculate charge amount in cents
        $chargeAmount = $order->products->sum('cost');

        Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        // For "test" tokens, go here:
        // https://stripe.com/docs/testing#cards
        try {
            $charge = Stripe\Charge::create([
                'amount' => $chargeAmount,
                'currency' => 'usd',
                'source' => $request->token // we let Stripe handle the credit card integrations
            ]);
        }
        catch (Stripe\Error\Base $e) {
            return ['status' => 'Payment Failure'];
        }

        // Mark order as complete
        $order->completed = true;
        $order->save();

        return ['status' => 'Payment Success'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }
}
