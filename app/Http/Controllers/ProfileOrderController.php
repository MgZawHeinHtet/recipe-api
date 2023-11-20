<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ProfileOrderController extends Controller 
{
    public function index(){
        $order=null;
        if($track = request()->tracker){
            $order = Order::with('order_status')->where('order_number',$track)->get(['order_status_id'])->first();
            
         };
        return view('profile.order-lists',[
            'order'=>$order
        ]);
    }
}