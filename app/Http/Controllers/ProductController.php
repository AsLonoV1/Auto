<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
     
    public function  List()
    {
    return   Product::limit(10)->get();  
    }


    public function     Show(Request $request)
    {
        return  Product::where('id',$request->id)->with('category')->first(); 
    }


    public function Create(Request $request)
    {
      
       $product= new Product();
       $product->category_id=$request->category_id;
       $product->product_title=$request->product_title;
       $product->product_amout=$request->product_amout;
       $product->product_count=$request->product_count;
       $product->product_chosen=0;
       $product->save();
       return 'Product created successfully';

    }

    public function Update(Request $request)
    {

        $product =Product::findOrFail($request->id);
        $product->update($request->all());
        return $product;
 
    }

    public function  Delete(Request $request)
    {
        $product =Product::findOrFail($request->id);
        $product->delete();
        return 'Product deleted';
    }

}
