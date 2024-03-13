<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // direct order list page
    public function orderList(){
        $order = Order::select('orders.*','users.name as user_name')
                    ->leftJoin('users','users.id','orders.user_id')
                    ->orderBy('created_at','desc')
                    ->get();
        return view('admin.order.orderList',compact('order'));
    }

    // ajax order
    public function changeStatus(Request $request){
        if($request->orderStatus == null){
            $order =Order::select('orders.*','users.name as user_name')
                    ->leftJoin('users','users.id','orders.user_id')
                    ->orderBy('created_at','desc')
                    ->get();
        }else{
            $order = Order::select('orders.*','users.name as user_name')
                        ->leftJoin('users','users.id','orders.user_id')
                        ->orderBy('created_at','desc')
                        ->where('orders.status',$request->orderStatus)->get();
        }
    return view('admin.order.orderList',compact('order'));
    }

    // ajax change status
    public function ajaxChangeStatus(Request $request){

        Order::where('id',$request->orderId)->update([
            'status' => $request->currentStatus
        ]);

        $order =Order::select('orders.*','users.name as user_name')
                    ->leftJoin('users','users.id','orders.user_id')
                    ->orderBy('created_at','desc')
                    ->get();

        return response()->json($order, 200);
    }

    // customer order list
    public function customerOrderList($orderCode){
        $order = Order::where('order_code',$orderCode)->first();
        $orderList = OrderList::select('order_lists.*','products.name as product_name','products.image as product_image','users.id as user_id','users.name as user_name','users.phone as user_phone','users.email as user_email','users.address as user_address')
                            ->leftJoin('products','products.id','order_lists.product_id')
                            ->leftJoin('users','users.id','order_lists.user_id')
                            ->where('order_lists.order_code',$orderCode)
                            ->get();
        return view('admin.order.customerOrderList',compact('orderList','order'));
    }

}
