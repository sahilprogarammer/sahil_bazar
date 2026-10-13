<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function orderSubmit(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Please login before placing order.',
            ], 401);
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'order_id' => 'required|integer|exists:orders,id',
            'payment_method' => 'required|in:cod,upi',
            'total_amount' => 'required|numeric|min:0',
        ]);


        /*
        |--------------------------------------------------------------------------
        | GET EXISTING ORDER
        |--------------------------------------------------------------------------
        |
        | Make sure this order belongs to logged-in user.
        |
        */

        $order = Order::where('id', $request->order_id)
            ->where('user_id', $user->id)
            ->first();


        if (!$order) {

            return response()->json([
                'success' => false,
                'message' => 'Invalid order.',
            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE ORDER
        |--------------------------------------------------------------------------
        */

        DB::beginTransaction();

        try {

            $order->update([
                'payment_method' => 'cod',
                'payment_status' => 2, // 2 = pending
                'order_status' => 'pending',

            ]);


            DB::commit();


            /*
            |--------------------------------------------------------------------------
            | REMOVE CHECKOUT SESSION
            |--------------------------------------------------------------------------
            |
            | Order is now successfully confirmed.
            |
            */

            session()->forget('checkout_order_id');


            return response()->json([

                'success' => true,

                'message' => 'Order placed successfully.',

                'order_id' => $order->id,

                'order_number' => $order->order_number,

                'total_amount' => $order->total_amount,

                'payment_method' => $order->payment_method,

                'payment_status' => $order->payment_status,

                'order_status' => $order->order_status,

                'redirect' => route('order.success'),

            ]);
        } catch (\Throwable $e) {

            DB::rollBack();


            return response()->json([

                'success' => false,

                'message' => 'Unable to place order.',

                'error' => $e->getMessage(),

            ], 500);
        }
    }



    public function create(Request $request)
    {
        $user = Auth::user();

        if (!$user) {

            return response()->json([
                'success' => false,
                'message' => 'Please login before making payment.',
            ], 401);
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'order_id' =>
            'required|integer|exists:orders,id',

            'payment_method' =>
            'required|in:upi',

            'address_id' =>
            'required|integer|exists:addresses,id',

            'total_amount' =>
            'required|numeric|min:0',

        ]);


        /*
        |--------------------------------------------------------------------------
        | GET EXISTING ORDER
        |--------------------------------------------------------------------------
        */

        $order = Order::where('id', $request->order_id)
            ->where('user_id', $user->id)
            ->first();


        if (!$order) {

            return response()->json([

                'success' => false,

                'message' => 'Invalid order.',

            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE ORDER FOR UPI
        |--------------------------------------------------------------------------
        */

        $order->update([

            'address_id' =>
            $request->address_id,

            'payment_method' =>
            'upi',

            /*
             * 0 = payment not completed
             */

            'payment_status' =>
            0,

            'order_status' =>
            'pending',

            'total_amount' =>
            $request->total_amount,

        ]);


        /*
        |--------------------------------------------------------------------------
        | YOUR PAYMENT GATEWAY CODE
        |--------------------------------------------------------------------------
        |
        | Put PhonePe / Razorpay / other gateway code here.
        |
        */


        /*
        |--------------------------------------------------------------------------
        | EXAMPLE RESPONSE
        |--------------------------------------------------------------------------
        |
        | Replace this with your real payment gateway response.
        |
        */

        return response()->json([

            'success' => true,

            'message' =>
            'Payment initialized.',

            'order_id' =>
            $order->id,

            'order_number' =>
            $order->order_number,

            'amount' =>
            $order->total_amount,

            /*
             * Your gateway payment URL should
             * be returned here.
             */

            // 'payment_url' => $paymentUrl,

        ]);
    }
}
