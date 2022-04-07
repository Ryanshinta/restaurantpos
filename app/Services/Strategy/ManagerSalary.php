<?php

namespace App\Services\Strategy;

class ManagerSalary implements SalaryStrategy
{

    public function calculateSalary(int $base, int $overTime, int $bonusRate, int $deduction): float
    {
        $bonus = ($base+$overTime-$deduction) * round(($bonusRate/100),2);
        return round($bonus,2) + $base + $overTime - $deduction;
//        round($bonus,2) + $base + $overTime - $deduction
    }
}
