<?php

namespace App\Http\Controllers;

use App\Models\ReservationDetail;
use Illuminate\Http\Request;

class ReservationDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $reservationdetails = ReservationDetail::all();
        return view ('reservationdetails.index')->with('reservationdetails', $reservationdetails);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() { 
        return view('reservationdetails.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //$input = $request->all();    
        ReservationDetail::create([
            'reserveId' => $request->input('reserveId'),
            'tableNo' => $request->input('tableNo'),
            'state' => $request->input('state')
        ]);
        return redirect('reservationdetail')->with('flash_message', 'Reservation Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $reservationdetails = ReservationDetail::find($id);
        return view('reservationdetails.show')->with('reservationdetails', $reservationdetails);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $reservationdetails = ReservationDetail::find($id);
        return view('reservationdetails.edit')->with('reservationdetails', $reservationdetails);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $reservationdetails = ReservationDetail::find($id);
        $input = $request->all();
        $reservationdetails->update($input);
        return redirect('reservationdetails')->with('flash_message', 'Reservation Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        ReservationDetail::destroy($id);
        return redirect('reservationdetails')->with('flash_message', 'Reservation deleted!');
    }
}
