<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        return view('products.index',['products' =>Product::latest()->paginate(2)
    ]);//here index.blade html code is fetching for view where its fetching it through variable pass
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        //validate data
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:1000'
        ]);





        //upload image
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('products'), $imageName);//moving the image in a public path naming a folder products
        // dd($imageName);

        $product = new Product;
        $product->image = $imageName;
        $product->name = $request->name;
        $product->description = $request->description;

        $product->save();
        return back()->withSuccess('Product created!!!!');
    }

    public function edit($id){

        $product = Product::where('id',$id)->first();

        return view('productsj.edit',['product' => $product]);
    }

    public function update(Request $request, $id){
        // dd($id);
                //validate data
                $request->validate([
                    'name' => 'required',
                    'description' => 'required',
                    'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:1000'
                ]);
        
                 $product = Product::where('id',$id)->first();

                 if(isset($request->image)){
                     //upload image
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('products'), $imageName);//moving the image in a public path naming a folder products
                $product->image = $imageName;
                // dd($imageName);
                 }
                
                $product->name = $request->name;
                $product->description = $request->description;
        
                $product->save();
                return back()->withSuccess('Product updated!!!!');
    }

    public function destroy($id){
        $product = Product::where('id',$id)->first();
        $product->delete();
        return back()->withSuccess('Product deleted !!!');
    }

    public function show($id){
        $product = Product::where('id',$id)->first();
        
        return view('products.show',['product'=>$product]);
    }
}
