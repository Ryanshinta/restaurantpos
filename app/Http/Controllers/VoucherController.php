<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Facades\Voucher as VoService;

class VoucherController extends Controller
{
    public function index()
    {
        $voucher = Http::get('http://127.0.0.1:9876/api/voucher');
        return view('voucher.index', ['Vouchers' => json_decode($voucher)]);
    }

    public function create(Request $request)
    {
//        $voucher = Http::post('http://127.0.0.1:9876/api/addVoucher',$request->all());
        return view('voucher.create');
    }

    public function store(Request $request)
    {


        if ($request->generateCode == 1){
            $request->validate([
                'code' => 'string|max:10',
                'type' => 'required|in:fixed,percentage',
                'value' => 'required|numeric',
                'isActive' => 'required',
                'expireDate' => 'required',
            ]);
            $result = Http::post('http://127.0.0.1:9876/api/addVoucher', [
                'code' => VoService::generateCode(6),
                'type' => $request->type,
                'value' => $request->value,
                'isActive' => $request->isActive,
                'expireDate' => $request->expireDate
            ]);

        }else{
            $request->validate([
                'code' => 'required|string|max:10',
                'type' => 'required|in:fixed,percentage',
                'value' => 'required|numeric',
                'isActive' => 'required',
                'expireDate' => 'required',
            ]);
            $result = Http::post('http://127.0.0.1:9876/api/addVoucher', [
                'code' => $request->code,
                'type' => $request->type,
                'value' => $request->value,
                'isActive' => $request->isActive,
                'expireDate' => $request->expireDate
            ]);
        }

        return redirect()->route('voucher.index');
    }

    public function edit(Request $request){

        $url = $request->getPathInfo();
        $newURL = explode('/', $url, 4);
        $url = $newURL[2];
        $voucher = Http::get('http://127.0.0.1:9876/api/voucher/'.$url);

        return view('voucher.edit',['voucher' => json_decode($voucher)]);

    }


    public function update(Request $request){
        $url = $request->getPathInfo();
        $newURL = explode('/', $url, 4);
        $url = $newURL[2];
        dd(url);

        $result = Http::post('http://127.0.0.1:9876/api/updateVoucher'.$url,[
            'code' => $request->code,
            'type' => $request->type,
            'value' => $request->value,
            'isActive' => $request->isActive,
            'expireDate' => $request->expireDate
        ]);


        error_log($result);
        dd($result);


        return redirect()->route('voucher.index');

    }

    public function destroy(Request $request)
    {
        //dd($request);
        $url = $request->getPathInfo();
        $newURL = explode('/', $url, 3);
        $url = $newURL[2];
        $result = Http::delete('http://127.0.0.1:9876/api/deleteVoucher/' . $url);

        return redirect()->route('voucher.index');
    }




}
