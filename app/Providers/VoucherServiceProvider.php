<?php

namespace App\Providers;

use App\Services\VoucherService;
use Illuminate\Support\ServiceProvider;

class VoucherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Voucher', VoucherService::class);
    }
}
