<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use function GuzzleHttp\Promise\all;

class VoucherController extends Controller
{
    public function index(){
        $voucher = Http::get('http://127.0.0.1:9876/api/voucher');
        return view('voucher.index',['Vouchers'=>json_decode($voucher)]);
    }

    public function create(Request $request){
//        $voucher = Http::post('http://127.0.0.1:9876/api/addVoucher',$request->all());
        return view('voucher.create');
    }

    public function store(Request $request){
        $request->validate([
            'code'=>'required|string|max:10',
            'type'=>'required|in:fixed,percentage',
            'value'=>'required|numeric',
            'isActive'=>'required',
            'expireDate'=>'required',
        ]);

//        $voucher = Voucher::create([
//            'code'=> $request->code,
//            'type'=> $request->type,
//            'value'=> $request->value,
//            'isActive'=> $request->isActive,
//            'expireDate'=> $request->expireDate
//        ]);
//        if (!$voucher){
//            return redirect()->back()->with('error', 'Sorry, there a problem while creating product');
//        }
        $token = Http::get('http://127.0.0.1:9876/token');

//        $result = Http::withHeaders([
//            'X-CSRF-TOKEN' => $token,
//        ])->post('http://127.0.0.1:9876/api/addVoucher',[
//            'code'=> $request->code,
//            'type'=> $request->type,
//            'value'=> $request->value,
//            'isActive'=> $request->isActive,
//            'expireDate'=> $request->expireDate
//        ]);
        $result = Http::post('http://127.0.0.1:9876/api/addVoucher',[
            'code'=> $request->code,
            'type'=> $request->type,
            'value'=> $request->value,
            'isActive'=> $request->isActive,
            'expireDate'=> $request->expireDate
        ]);
       // dd($result);

        return redirect()->route('voucher.index');
    }


    public function destroy(Request $request){
        //dd($request);
        $url = $request->getPathInfo();
        $newURL = explode('/',$url,3);
        $url = $newURL[2];
        $result = Http::delete('http://127.0.0.1:9876/api/deleteVoucher/'.$url);

        return redirect()->route('voucher.index');
    }


}
