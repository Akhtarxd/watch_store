<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
       $orders = Order::with('customerData')->get(); 
       return view('admin.orderList',['orders'=> $orders]);
    }

    public function changeOrderStatus(Request $request,$id){
        Order::where('id',$id)->update(['status'=>$request->status ?? null]);
        return redirect()->back()->with('success', 'Order Status Change Successfully');
    }

    public function getLineItems(Request $request,$id){
        $requestData = Order::where('id',$id)->with('lineItemsData')->first();
        return view('admin.lineItemList',compact('requestData'));
    }
}
