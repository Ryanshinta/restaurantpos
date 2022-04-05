<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Voucher;
use Carbon\Carbon;
use function MongoDB\BSON\toJSON;

class VoucherService
{
    public function checkAvailable(Voucher $voucher, Order $order){
        if ($voucher->isActive){
            return toJSON('The voucher is not active');
        }
        if ($voucher->expireDate->lt(Carbon::now()) ){
            return toJSON('The voucher is expired');
        }
    }
}
