<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductApiController extends Controller
{
    public function getAllProduct(){
        return response()->json(Product::all(),200);
    }

    public function getProductById($id){
       $product =  DB::table('products')->where('id',$id)->first();
       if (is_null($product)){
           return response()->json(['message' => 'product not found'], 404);
       }
       return response()->json($product,200);
    }
}
