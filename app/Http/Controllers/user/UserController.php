<?php

namespace App\Http\Controllers\user;

use Storage;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // direct user home page
    public function home(){
        $pizza = Product::orderBy('created_at','desc')->get();
        $categories = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','categories','cart','history'));
    }

    // user list page
    public function userList(){
        $users = User::when(request('key'),function($query){
                                $query->orWhere('name','like','%'.request('key').'%')
                                      ->orWhere('email','like','%'.request('key').'%')
                                      ->orWhere('phone','like','%'.request('key').'%')
                                      ->orWhere('gender','like','%'.request('key').'%')
                                      ->orWhere('address','like','%'.request('key').'%');
                            })
                            ->where('role','user')
                            ->orderBy('created_at','desc')
                            ->paginate(3);
            $users->appends(request()->all);
            return view('admin.account.userList',compact('users'));
    }

    // user delete
    public function userDelete($id){
        User::where('id',$id)->delete();
        return back();
    }

    // user edit page
    public function userEdit($id){
        $user = User::where('id',$id)->first();
        return view('admin.account.editUser',compact('user'));
    }

    // user edit update
    public function userUpdate($id, Request $request){
        $this->updateValidationCheck($request);
        $data = $this->getUpdateData($request);

        if($request->hasFile('image')){
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }
            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }
        User::where('id',$id)->update($data);
       return redirect()->route('admin#userList');
    }

    // ajax user to admin change
    public function ajaxUserChange(Request $request){
           User::where('id',$request->userId)->update([
            'role' => $request->currentStatus
        ]);

    }

    // direct password change page
    public function changePasswordPage(){
        return view('user.password.change');
    }

    // change password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbHashPassword = $user->password;

        if(Hash::check($request->oldPassword, $dbHashPassword)){
            $data = [
                'password' => Hash::make($request->newPassword)
            ];

            User::where('id',Auth::user()->id)->update($data);
            return back()->with(['changeSuccess'=>'Password Change Success!']);
        }
        return back()->with(['notMatch' => 'The old password is not match. Try again!']);
    }

    // account change page
    public function accountChangePage(){
        return view('user.profile.account');
    }
    // filter
    public function filter($categoryId){
        $pizza = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $categories = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','categories','cart','history'));

    }

    // direct pizza details
    public function pizzaDetails($pizzaId){
        $pizza = Product::where('id',$pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.detail',compact('pizza','pizzaList'));
    }

    // cart list
    public function cartList(){
        $cartList =Cart:: select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as pizza_image')
                    ->leftJoin('products','products.id','carts.product_id')
                    ->where('carts.user_id',Auth::user()->id)
                    ->get();

        $totalPrice = 0;
        foreach ($cartList as $c) {
           $totalPrice += $c->pizza_price*$c->qty;
        }

        return view('user.main.cart',compact('cartList','totalPrice'));
    }

    // direct history page
    public function history(){
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(6);
        return view('user.main.history',compact('order'));
    }

    // account change
    public function accountChange($id,Request $request){
        $this->updateValidationCheck($request);
        $data = $this->getUpdateData($request);

        if($request->hasFile('image')){
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;

        }
        User::where('id',$id)->update($data);
            return back();
    }

    // account update get data
    private function getUpdateData($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'gender'=>$request->gender,
            'address'=>$request->address,
            'updated_at'=>Carbon::now()
        ];
    }

    // account update validation check
    private function updateValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'image' =>'mimes:png,jpg,jpeg,webp|file',
            'gender' => 'required',
            'address' => 'required'
        ])->validate();
    }

    // passwordValidationCheck
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' =>'required|min:6|max:10',
            'newPassword' =>'required|min:6|max:10',
            'confirmPassword' =>'required|min:6|max:10|same:newPassword'
        ])->validate();
    }
}
