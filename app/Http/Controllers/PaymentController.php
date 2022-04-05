<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use DB;

class PaymentController extends Controller {

    private int $id;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        echo "hello";
        $orderid = Order::max('orderID');
        $this->id = $orderid;


        $orders = DB::table('orders')->where('orderID', '=', $orderid)->get();
        $order__details = DB::table('order__details')->where('orderID', '=', $orderid)->get();

        return view('payment.create')->with('order__details', $order__details)->with('orders', $orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }
   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $orders = DB::table("orders")->select('*')
                ->where('id', '=', $id)
                ->whereNOTIn('id', function($query) {
                    $query->select('id')->from('payment');
                })
                ->get();

        $order__details = DB::table('order__details')->where('order_id', '=', $id)->get();

        $products = Product::all();


        return view('payment.show')->with('orders', $orders)->with('order__details', $order__details)->with('products', $products);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
