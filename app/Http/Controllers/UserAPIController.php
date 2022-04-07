<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserAPIController extends Controller
{
    public function getAllUser(){
        return response()->json(User::all(),200);
    }

    public function getUser($ic){
        $user =  DB::table('users')->where('icNumber',$ic)->first();
        if (is_null($user)){
            return response()->json(['message' => 'User Not Registered'], 404);
        }
        return response()->json($user,200);
    }

    public function addUser(Request $request){
        $user = User::create($request->all());
        return response($user,201);
    }

    public function editUser(Request $request, $ic){
        $user =  DB::table('users')->where('icNumber',$ic)->first();
        if (is_null($user)){
            return response()->json(['message' => 'User Not Registered'], 404);
        }
        $voucher = DB::table('users')->where('icNumber',$ic)->update($request->all());
        return response($voucher,200);
    }

    public function deleteUser(Request $request, $ic){
        $voucher =  DB::table('users')->where('icNumber',$ic)->first();
        if (is_null($voucher)){
            return response()->json(['message' => 'User Not Registered'], 404);
        }
        $voucher = DB::table('users')->where('icNumber',$ic)->delete();
        return response()->json(['message'=>'Remove user successes'],200);
    }
}
