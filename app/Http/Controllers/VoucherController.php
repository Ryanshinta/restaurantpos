<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Facades\Voucher as ServiceVo;


class VoucherController extends Controller
{
    public function getAllVoucher(){
        return response()->json(Voucher::all(),200);
    }

    public function getVoucherByCode($code){
       $voucher =  DB::table('vouchers')->where('code',$code)->first();
       if (is_null($voucher)){
           return response()->json(['message' => 'Voucher Not Found'], 404);
       }
       return response()->json($voucher,200);

    }


}
