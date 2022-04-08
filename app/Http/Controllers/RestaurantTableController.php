<?php

namespace App\Http\Controllers;

use App\Models\RestaurantTable;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DB;

class RestaurantTableController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
//        $restauranttables = RestaurantTable::all();

        $response = Http::acceptJson()->get('http://127.0.0.1:8081/api/table');
        $userdata = json_decode($response);
        return view('restauranttables.index')->with('userdata', $userdata);
    }

    public function orderTable() {
        $available = 'Available';
        $restauranttables = DB::table('restauranttables')->where('tableStatus', $available)->get();
        return view('restauranttables.orderTable')->with('restauranttables', $restauranttables);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $tableNum = RestaurantTable::all()->count();
        $tableNum = $tableNum + 1;

        return view('restauranttables.create')->with('tableNum', $tableNum);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $tableNum = RestaurantTable::all()->count();
        $tableNum = $tableNum + 1;
        //$input = $request->all();    
        RestaurantTable::create([
            'tableNo' => $tableNum,
            'tableType' => $request->input('tableType'),
            'maxSeats' => $request->input('maxSeats')
        ]);

        $this->newXml();
        return redirect('restaurantTable')->with('flash_message', 'Table Added!');
    }

    public function sort() {
        $xml = new \DOMDocument();
        $xml->load('xml/TableInfo.xml');

        $xsl = new \DOMDocument();
        $xsl->load('xml/staff_sort_position.xslt');

        $proc = new \XSLTProcessor();
        $proc->importStylesheet($xsl);
        $x = $proc->transformToXml($xml);
        return view('restauranttables.search')->with('x', $x);
    }

    public function newXml() {
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
            }

            echo "<xmp>" . $xml->saveXML() . "</xmp>";
            $xml->save("xml/TableInfo.xml") or die("Unable to create xml");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $restauranttable = RestaurantTable::find($id);
        return view('restauranttables.show')->with('restauranttables', $restauranttable);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $restauranttable = RestaurantTable::find($id);
        return view('restauranttables.edit')->with('restauranttables', $restauranttable);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $restauranttable = RestaurantTable::find($id);
        $input = $request->all();
        $restauranttable->update($input);
        $this->newXml();
        return redirect('restaurantTable')->with('flash_message', 'Table Updated!');
    }

    public function orderUpdate(Request $request) {
        $orderid = DB::table('orders')->max('id');
        echo $orderid;
        $restauranttable = RestaurantTable::find($request['tableNo']);

        $restauranttable->update(['orderID' => $orderid]);
        $restauranttable->update(['tableStatus' => 'Served']);
        $this->newXml();
        return redirect('payment');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $table = Http::delete('http://127.0.0.1:8081/api/deleteTable/' . $id);
        $this->newXml();
        return redirect('restaurantTable')->with('flash_message', 'Table deleted!');
    }

}
