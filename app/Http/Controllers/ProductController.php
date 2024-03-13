<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // direct list page
    public function list(){
        $pizza = Product::select('products.*','categories.name as category_name')
                ->when(request('key'),function($query){
                $query->where('products.name','like','%'.request('key').'%');
                })
                ->leftJoin('categories','products.category_id','categories.id')
                ->orderBy('products.created_at','desc')
                ->paginate(3);

        $pizza->appends(request()->all());

        return view('admin.product.list',compact('pizza'));
    }

    // direct create page
    public function createPage(){
        $categories = Category::select('id','name')->get();
        return view('admin.product.create',compact('categories'));
    }

    // pizza create
    public function create(Request $request){
        $this->productValidationCheck($request,"create");
        $data = $this->requestProductInfo($request);


        $fileName = uniqid(). $request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image'] = $fileName;

        Product::create($data);
        return redirect()->route('product#list');

    }

    // pizza delete
    public function delete($id){
        Product::where('id',$id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess' => 'Delete Success!']);
    }

    //pizza view page
    public function viewPage($id){
        $pizza = Product::select('products.*','categories.name as category_name')
                         ->leftJoin('categories','products.category_id','categories.id')
                         ->where('products.id',$id)
                         ->first();
        return view('admin.product.view',compact('pizza'));
    }

    // pizza edit page
    public function editPage($id){
        $pizza = Product::where('id',$id)->first();
        $category = Category::get();
        return view('admin.product.edit',compact('pizza','category'));
    }

    // pizza update
    public function update(Request $request){
        $this->productValidationCheck($request,"update");
        $data = $this->requestProductInfo($request);

        if($request->hasFile('pizzaImage')){
            $oldImageName = Product::where('id',$request->pizzaId)->first();
            $oldImageName = $oldImageName->image;

            if($oldImageName != null){
                Storage::delete('public/'.$oldImageName);
            }
           $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }
        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('product#list');
    }

    // get pizza data
    private function requestProductInfo($request){
        return [
            'category_id' =>$request->pizzaCategory,
            'name' =>$request->pizzaName,
            'description' =>$request->pizzaDescription,
            'price' =>$request->pizzaPrice,
            'waiting_time' =>$request->pizzaWaitingTime
        ];
    }

    // pizza create validation check
    private function productValidationCheck($request,$status){
        $validationRules = [
            'pizzaName' => 'required|unique:products,name,'.$request->pizzaId,
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required',
            'pizzaPrice' => 'required',
            'pizzaWaitingTime' =>'required'

        ];
        $validationRules['pizzaImage'] = $status == 'create' ? 'required|mimes:png,jpg,jpeg,webp|file' : 'mimes:png,jpg,jpeg,webp|file';

        Validator::make($request->all(),$validationRules)->validate();
    }
}
