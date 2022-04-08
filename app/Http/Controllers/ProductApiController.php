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

    public function addProduct(Request $request){
        $product = Product::create($request->all());
        return response($product,201);
    }

    public function updateProduct(Request $request, $product){
        $product =  DB::table('products')->where('product',$product)->first();
        if (is_null($product)){
            return response()->json(['message' => 'product Not Found'], 404);
        }
        $product = DB::table('products')->where('product',$product)->update($request->all());
        return response($product,200);
    }


    public function deleteVoucher(Request $request, $product){
        $product =  DB::table('products')->where('product',$product)->first();
        if (is_null($product)){
            return response()->json(['message' => 'product Not Found'], 404);
        }
        $product = DB::table('products')->where('product',$product)->delete();
        return response()->json(['message'=>'Delete successesful'],200);
    }
}
