<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Reservation;
use App\Models\RestaurantTable;
use App\Models\ReservationRestaurantTable;
use Illuminate\Http\Request;

class ReservationController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $reservations = Reservation::all();
        return view('reservations.index')->with('reservations', $reservations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $reserveId = DB::table('reservations')
            ->latest()
            ->first();
        if (!empty($reserveId)) {
            $currentId = $reserveId->reserveId;
            if (substr($currentId, 1, 6) == date("ymd")) {
                $newId = (int) substr($currentId, 8, 2);
                $test = $newId + 1;
                $new = sprintf("%02d", $test);
                $reserveId = "R" . date("ymd") . "/" . $new;
            } else {
                $reserveId = "R" . date("ymd") . "/" . '01';
            }
        } else {
            $reserveId = "R" . date("ymd") . "/" . '01';
        }
        return view('reservations.create')->with('reserveId', $reserveId);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        Reservation::create([
            'reserveId' => $request->input('reserveId'), 'reserveDate' => $request->input('reserveDate'),
            'reserveSlot' => $request->input('reserveSlot'), //'reserveStatus' => $request->input('reserveStatus'),
            'noTableReserve' => $request->input('noTableReserve'), 'noOfCust' => $request->input('noOfCust'),
            'custName' => $request->input('custName'), 'custMobile' => $request->input('custMobile'),
        ]);

        $d = $request->input('reserveDate');
        $s = $request->input('reserveSlot');
        $n = $request->input('noTableReserve');
        $r = $request->input('reserveId');

        $restauranttables = $this->showTable($d, $s);
        return view('reservations.addTable')->with('restauranttables', $restauranttables)->with('n', $n)->with('r', $r);
    }

    public function showTable($d, $s) {
        $restauranttables = DB::table('restauranttables')
            ->select('tableNo', 'maxSeats')->whereNotIn('tableNo', function ($unavailable) use ($d, $s) {
                $unavailable->select('restauranttables.tableNo')->from('restauranttables')
                    ->join('reservation_restaurant_tables', 'restauranttables.tableNo', '=', 'reservation_restaurant_tables.tableNo')
                    ->join('reservations', 'reservation_restaurant_tables.reserveId', '=', 'reservations.reserveId')
                    ->where('reservations.reserveDate', '=', $d)
                    ->where('reservations.reserveSlot', '=', $s);
            })
            ->get();
        return $restauranttables;
    }

    public function addTable(Request $request) {
        $id = $request->input('reserveId');
        $reservation = Reservation::find($id);
        $reservation->restauranttables()->attach($request->tableNo);
        Reservation::where('reserveId', $id)->update(array('reserveStatus' => 'Confirmed'));
        return redirect('reservation')->with('flash_message', 'Table Selected!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($reserveId) {
        $reservation = Reservation::find($reserveId);

        return view('reservations.show')->with('reservations', $reservation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($reserveId) {
        $reservation = Reservation::find($reserveId);

        return view('reservations.edit')->with('reservations', $reservation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $reserveId) {
        $reservation = Reservation::find($reserveId);

        if ($request->input('noTableReserve') != $reservation->getOriginal('noTableReserve')) {
            $reservation->restauranttables()->detach($request->tableNo);
            $n = $request->input('noTableReserve'); $r = $reserveId;
            $d = $request->input('reserveDate'); $s = $request->input('reserveSlot');
            $restauranttables = $this->showTable($d, $s);
            return view('reservations.addTable')->with('restauranttables', $restauranttables)->with('n', $n)->with('r', $r);
        }
        $input = $request->all();
        $reservation->update($input);
        return redirect('reservation')->with('flash_message', 'Reservation Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($reserveId) {
        Reservation::destroy($reserveId);
        return redirect('reservation')->with('flash_message', 'Reservation deleted!');
    }

}
