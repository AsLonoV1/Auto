<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    
    public function     List()
    {
    return   Category::limit(10)->get();  
    }


    public function Show(Request $request)
    {
       return  Category::where('id',$request->id)->with('products')->first(); 
    }


    public function Create(Request $request)
    {
      
        Category::create($request->all());
       return 'Category created successfully';

    }

    public function Update(Request $request)
    {

        $category =Category::findOrFail($request->id);
        $category->update($request->all());
        return $category;
 
    }

    public function  Delete(Request $request)
    {
        $category =Category::findOrFail($request->id);
        $category->delete();
        return 'Category deleted';
    }

}
