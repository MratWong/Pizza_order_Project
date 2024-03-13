<?php

namespace App\Http\Controllers\user;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    // direct pizza list
    public function pizzaList(Request $request){
        if($request->status == 'asc'){
            $data = Product::orderBy('created_at','asc')->get();
        }else{
            $data = Product::orderBy('created_at','desc')->get();
        }
        return $data;
    }

    // direct cart list
    public function atToCart(Request $request){

        $data = $this->getCartListData($request);
        Cart::create($data);
        $response = [
            'status' => 'success',
            'message' =>'Add to cart completed'
        ];
        return response()->json($response, 200);
    }

    // direct cart btn
    public function directCart(Request $request){
        logger($request->toArray());
        $data = $this->getCartListData($request);
        Cart::create($data);
        $response = [
            'status' => 'success',
            'message' =>'Add to cart completed'
        ];
        return response()->json($response, 200);
    }

    // direct buy btn
    public function directBuy(Request $request){
        $data = OrderList::create([
            'user_id' => $request->userId,
            'product_id' =>$request->pizzaId,
            'qty' =>$request->count,
            'total' =>$request->total,
            'order_code' =>$request->orderCode
        ]);

        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $data->total + 2500
        ]);

         $response = [
            'status' => 'success',
            'message' =>'Add to order completed'
        ];
        return response()->json($response, 200);
    }

    // order
    public function order(Request $request){
       $totalPrice = 0;
       foreach ($request->all() as $item) {
           $data = OrderList::create([
                'user_id' =>$item['userId'],
                'product_id' =>$item['productId'],
                'qty' =>$item['qty'],
                'total' =>$item['total'],
                'order_code' =>$item['orderCode']
            ]);
        $totalPrice += $data->total;

       }
        Cart::where('user_id',Auth::user()->id)->delete();
        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $totalPrice + 2500
        ]);
        return response()->json([
            'status' => ' success',
            'message' => 'Add order list completed'
        ], 200);
    }

    // clear cart
    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    // clear cart item
    public function clearCartItem(Request $request){
        Cart::where('user_id',Auth::user()->id)->where('id',$request->cartId)->where('product_id',$request->productId)->delete();
    }
    //increase view count
    public function increaseViewCount(Request $request){
        $pizza = Product::where('id',$request->pizzaId)->first();

        $viewCount = [
            'view_count' => $pizza->view_count + 1
        ];

        Product::where('id',$request->pizzaId)->update($viewCount);
    }

    // user send message
    public function userSendMessage(Request $request){

        $contact = Contact::create([
            'sender_id' => Auth::user()->id,
            'message'   => $request->userMessage
        ]);

        return $contact;
    }

    // get cart data
    private function getCartListData($request){
        return[
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'qty' => $request->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
