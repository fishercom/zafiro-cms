<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderPayment;
use App\Quotation;
use App\QuotationLog;

use Auth;

class PaymentController extends Controller
{

    public function payment_response(Request $request){

        $order_id   = $request->purchaseOperationNumber; //session_id
        $session_id = $request->reserved1; //session_id

        $order  = Order::where('id', $order_id)->where('session_id', $session_id)->first();
        if(!$order){
            return redirect()->back()
                ->withInput($request->all())
                ->with('error', 'Parámetros insuficientes!');
        }

        $order_payment = OrderPayment::create([
            'order_id'=>$order->id, 
            'purchaseOperationNumber' => $request->purchaseOperationNumber,
            'purchaseAmount' => $request->purchaseAmount,
            'purchaseCurrencyCode' => $request->purchaseCurrencyCode,
            'descriptionProducts' => $request->descriptionProducts,
            'authorizationResult' => $request->authorizationResult,
            'authorizationCode' => $request->authorizationCode,
            'errorCode' => $request->errorCode,
            'errorMessage' => $request->errorMessage,
            //'metadata' => $request
        ]);
        $order->status = $order_payment->authorizationResult=='00'? 'PAID': 'REFUSED';
        $order->save();

        $member = $order->member;

        $user   = $member->user;
        Auth::login($user); //TODO: Fix expired sessions

        return redirect('/order_results/?order_id='.$order->id);
    }

}
