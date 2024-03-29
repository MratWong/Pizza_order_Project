<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct category page

    public function list (){
        $categories = Category::when(request('key'),function($query){
                                    $query->where('name','like','%'.request('key').'%');
                                    })
                                    ->orderBy('id','desc')
                                    ->paginate(3);
                $categories->appends(request()->all());
        return view('admin.category.list',compact('categories'));
    }

    //direct category createPage
    public function createPage(){
        return view('admin.category.create');
    }

    //category create
    public function create(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route('category#list');
    }

    //Category Delete
    public function delete($id){
        Category::where('id',$id)->delete();
        return back()->with(['deleteSuccess' => 'Delete Success!']);
    }

    //Category Edit
    public function edit($id){
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    // Category Update
     public function update( Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::where('id',$request->categoryId)->update($data);
        return redirect()->route('category#list');

     }

    //category validation check
    private function categoryValidationCheck ($request){
        Validator::make($request->all(),[
            'categoryName' => 'required|unique:categories,name,'.$request->categoryId
        ])->validate();
    }

    //request Category Data
    private function requestCategoryData($request){
        return [
            'name' => $request->categoryName
        ];
    }
}
