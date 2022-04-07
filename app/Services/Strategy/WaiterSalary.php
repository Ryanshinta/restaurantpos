<?php

namespace App\Services\Strategy;

class WaiterSalary implements SalaryStrategy
{

    public function calculateSalary(int $base, int $overTime, int $bonusRate, int $deduction): float
    {
        return $base - $deduction;
    }
}
