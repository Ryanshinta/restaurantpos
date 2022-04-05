<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Facades\Voucher as ServiceVo;
use mysql_xdevapi\TableUpdate;


class VoucherAPIController extends Controller
{
    public function getAllVoucher(){
        return response()->json(Voucher::all(),200);
    }

    public function getVoucherByCode($code){
       $voucher =  DB::table('vouchers')->where('code',$code)->first();
       if (is_null($voucher)){
           return response()->json(['message' => 'voucher Not Found'], 404);
       }
       return response()->json($voucher,200);
    }

    public function addVoucher(Request $request){
        $voucher = Voucher::create($request->all());
        return response($voucher,201);
    }

    public function updateVoucher(Request $request, $code){
        $voucher =  DB::table('vouchers')->where('code',$code)->first();
        if (is_null($voucher)){
            return response()->json(['message' => 'voucher Not Found'], 404);
        }
        $voucher = DB::table('vouchers')->where('code',$code)->update($request->all());
        return response($voucher,200);
    }


    public function deleteVoucher(Request $request, $code){
        $voucher =  DB::table('vouchers')->where('code',$code)->first();
        if (is_null($voucher)){
            return response()->json(['message' => 'voucher Not Found'], 404);
        }
        $voucher = DB::table('vouchers')->where('code',$code)->delete();
        return response()->json(['message'=>'Delete successes'],200);
    }







}
