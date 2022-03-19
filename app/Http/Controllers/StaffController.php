<?php

namespace App\Http\Controllers;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs = Staff::all();
        return view ('staffs.index')->with('staffs', $staffs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staffs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$input = $request->all();    
        $request->validate([
            'icNumber' => 'unique:staffs|regex:/^\d{6}-\d{2}-\d{4}$/',
            'name' => "regex:/^[a-zA-Z-'\s]+$/",
            'password' => "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/",
            'mobile' => "regex:/^\d{3}-\d{7}$/",
            'email' => "email"
        ]);
        
        Staff::create([
            'icNumber' => $request->input('icNumber'),
            'name' => $request->input('name'),
            'position' => $request->input('position'),
            'password' => $request->input('password'),
            'gender' => $request->input('gender'),
            'mobile' => $request->input('mobile'),
            'email' => $request->input('email'),
            'birthday' => $request->input('birthday'),
            'address' => $request->input('address')
        ]);
        return redirect('staff')->with('flash_message', 'Staff Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $staff = Staff::find($id);
        return view('staffs.show')->with('staffs', $staff);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staff  = Staff::find($id);
        return view('staffs.edit')->with('staffs', $staff);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $staff = Staff::find($id);
        $input = $request->all();
        $staff->update($input);
        return redirect('staff')->with('flash_message', 'Staff Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Staff::destroy($id);
        return redirect('staff')->with('flash_message', 'Staff deleted!');
    }
   
}
