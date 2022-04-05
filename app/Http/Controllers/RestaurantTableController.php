<?php

namespace App\Http\Controllers;
use App\Models\RestaurantTable;
use Illuminate\Http\Request;

class RestaurantTableController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $restauranttables = RestaurantTable::all();
        return view ('restauranttables.index')->with('restauranttables', $restauranttables);
    }
    
    public function display() {
        $restauranttables = RestaurantTable::all();
        return view ('restauranttables.display')->with('restauranttables', $restauranttables);
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
        return redirect('restaurantTable')->with('flash_message', 'Table Added!');
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
        return redirect('restaurantTable')->with('flash_message', 'Table Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        RestaurantTable::destroy($id);
        return redirect('restaurantTable')->with('flash_message', 'Table deleted!');
    }

}
