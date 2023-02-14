<?php

namespace App\Http\Controllers;

use App\Models\Sold;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    
  public function basket(Request $request){

     $product=Product::where('id',$request->id)->first();
         if($product->product_count>$product->product_chosen){
            if($product->product_chosen==0){
                $sold= new Sold();
                $sold->user_id=$request->user()->id;
                $sold->product_id=$product->id;
                $sold->product_name=$product->product_title;
                $sold->product_amout=$product->product_amout;
                $sold->product_chosen=1;
                $product->product_chosen=1;
                $sold->save();
                $product->save();
            }else{
                $sold=Sold::where('product_id',$product->id)->first();
                $sold->product_chosen=$sold->product_chosen+1;
                $product->product_chosen=$product->product_chosen+1;
                $product->save();
                $sold->save();
              }
            }else{ return 'Sorry this product out of';}
         return 'Done basket successfully';
  }
  

  public function abort(Request $request){

    $sold=Sold::where('product_id',$request->id)->first();
    
        if($sold!=null){

            if($sold->product_chosen>1) {
                $sold->product_chosen=$sold->product_chosen-1;
                $sold->save();
            }else{
              $product=Product::where('id',$request->id)->first();
              $product->product_chosen=0;
              $sold->delete();
              $product->save();
            }
            return 'Done abort successfully';

        }else{
            return 'There is no the product ';
            }

  }
  
  public function order(){
    
    $soldProducts=User::where('id',Auth::User()->id)->with('soldProducts')->first();

    $solds=Sold::all();
    $products=Product::all();
    
    
    foreach($products as $product){
      $product->product_count=$product->product_count-$product->product_chosen;
        $product->product_chosen=0;
        $product->save();
    } 

    foreach($solds as $sold){
        $sold->delete();
    }
     
    return $soldProducts;
    
  }


}
