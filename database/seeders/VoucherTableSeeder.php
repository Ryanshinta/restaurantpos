<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class VoucherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Voucher::create([
            'code'=>'ABC123',
            'type'=>'percentage',
            'value'=>'5',
            'isActive'=>true,
            'expireDate'=>Carbon::tomorrow(),
        ]);
        Voucher::create([
            'code'=>'DEF456',
            'type'=>'fixed',
            'value'=>'10',
            'isActive'=>false,
            'expireDate'=>Carbon::yesterday(),
        ]);
    }
}
