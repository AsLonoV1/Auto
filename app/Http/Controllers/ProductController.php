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


    public function Show(Request $request)
    {
        return  Product::where('id',$request->id)->first(); 
    }


    public function Create(Request $request)
    {
      
        Product::create($request->all());
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
