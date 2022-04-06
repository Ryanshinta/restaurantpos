<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Voucher;
use Carbon\Carbon;
use function MongoDB\BSON\toJSON;
use Illuminate\Support\Str;

class VoucherService
{
    public function checkAvailable(Voucher $voucher, Order $order){
        if ($voucher->isActive){
            return toJSON('The voucher is not active');
        }
        if ($voucher->expireDate->lt(Carbon::now()) ){
            return toJSON('The voucher is expired');
        }
        return toJSON(false);
    }

    public function generateCode($length){
        do{
            $code = strtoupper(Str::random($length));
        }while(Voucher::query()->where('code',$code)->exists());
        return $code;
    }

}
