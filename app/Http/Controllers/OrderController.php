<?php

namespace App\Http\Controllers;

use DB;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return view('orders.index', ['product' => $product]);
    }

    public function cart()
    {
        return view('cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //$user_id = Auth::id();

        $order = new Order();
        //$order->user_id = $user_id;
        $order->save();

        $orderId = $order->id;

        $totalPrice = 0;
        $carts = session()->get('cart');
        foreach($carts as $id=>$cart){
            DB::table('orders_list')->insert([
                'order_id' => $orderId,
                'product_id' => $cart["pid"],
                'quantity' => $cart["quantity"],
                'subtotal' => $cart["price"] * $cart["quantity"],
            ]);

            $totalPrice = $totalPrice + ($cart["price"] * $cart["quantity"]);
        }

        $order->total_price = $totalPrice;
        $order->save();
        $this->makeXml();

        $request->session()->forget('cart');

        return redirect('/orderTable')->with('success', 'Order Submitted')->with('orderId', $orderId);

    }

    public function makeXml()
    {
        $path = 'public/xml/orderDetails.xml';
        if (file_exists($path)) {
            unlink($path);
        } else {
            $results = Order::all();

            $xml = new \DOMDocument('1.0');
            $xml->formatOutput = true;

            $orders = $xml->createElement('Order');
            $xml->appendChild($orders);

            foreach ($results as $row) {
                $order = $xml->createElement("order");
                $orders->appendChild($order);

                $ID = $xml->createElement("ID", $row['id']);
                $order->appendChild($ID);

                $Status = $xml->createElement("Status", $row['status']);
                $order->appendChild($Status);

                $totalPrice = $xml->createElement("totalPrice", $row['total_price']);
                $order->appendChild($totalPrice);

                $createdAt = $xml->createElement('createdAt',$row['created_at']);
                $order->appendChild($createdAt);

                $updatedAt = $xml->createElement('updatedAt',$row['updated_at']);
                $order->appendChild($updatedAt);
            }

            echo "<xmp>" . $xml->saveXML() . "</xmp>";
            $xml->save("xml/orderDetails.xml") or die("Unable to create xml");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();

        $product->name = $request->input('name');
        $product->price = $request->input('price');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('storage/products', $filename);
            $product->image = $filename;
        }else{
            return $request;
            $product->image = '';
        }

        $product->save();

        return view('product')->with('product', $product);
        
    }

    public function add(){
        $product = Product::all();
        return view('orders/add', ['product' => $product]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(order $order)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
