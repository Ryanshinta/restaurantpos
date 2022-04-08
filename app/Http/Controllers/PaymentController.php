<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Payment;
use App\Models\RestaurantTable;

use DB;

class PaymentController extends Controller {

    private int $id;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $restauranttables = DB::table('restauranttables')->where('tableStatus', 'Served')->get();
        return view('payment.index')->with('restauranttables', $restauranttables);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {

        return view('payment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {


        $payment = Payment::create([
                    'orderID' => $request->orderid,
                    'applyVoucher' => $request->voucher,
                    'voucherDiscount' => $request->discount,
                    'serviceTax' => $request->tax,
                    'PaymentTotal' => $request->total,
                    'paymentStatus' => 'Paid'
        ]);

        DB::table('restauranttables')->where('orderID', $request->orderid)->update(['tableStatus' => 'Available', 'orderID' => null]);
        
        $path = 'public/xml/TableInfo.xml';
        if (file_exists($path)) {
            unlink($path);
        } else {
            $results = RestaurantTable::all();

            $xml = new \DOMDocument('1.0');
            $xml->formatOutput = true;

            $tables = $xml->createElement('tables');
            $xml->appendChild($tables);

            foreach ($results as $row) {
                $table = $xml->createElement("table");
                $tables->appendChild($table);

                $tableStatus = $xml->createElement("tableStatus", $row['tableStatus']);
                $table->appendChild($tableStatus);

                $tableType = $xml->createElement("tableType", $row['tableType']);
                $table->appendChild($tableType);

                $maxSeats = $xml->createElement("maxSeats", $row['maxSeats']);
                $table->appendChild($maxSeats);

                $orderID = $xml->createElement("orderID", $row['orderID']);
                $table->appendChild($orderID);

                $dateCreated = $xml->createElement("dateCreated", $row['dateCreated']);
                $table->appendChild($dateCreated);
            }

            echo "<xmp>" . $xml->saveXML() . "</xmp>";
            $xml->save("xml/TableInfo.xml") or die("Unable to create xml");
        }

        return redirect()->route('payment.index')->with('success', 'Success, you product have been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function validateVoucher($code) {
        $voucher = DB::table('vouchers')->where('code', '=', $code)->get();

        if (!empty($voucher)) {
            if ($voucher->type == 'percentage') {
                $voucher->value = $voucher->value / 100;
            } else {
                $voucher->value = $voucher->value;
            }
        }

        return $voucher;
    }

    public function show($id) {
        $orders = DB::table("orders")->select('*')
                ->where('id', '=', $id)
                ->whereNOTIn('id', function($query) {
                    $query->select('orderID')->from('payment');
                })
                ->get();

        $orders_list = DB::table('orders_list')->where('order_id', '=', $id)->get();

        $products = Product::all();

        $voucher = DB::table('vouchers')->select('*')->get();

        return view('payment.show')->with('orders', $orders)->with('orders_list', $orders_list)->with('products', $products)->with('voucher', $voucher);
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
