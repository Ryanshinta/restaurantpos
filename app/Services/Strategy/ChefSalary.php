<?php

namespace App\Services\Strategy;

class ChefSalary implements SalaryStrategy
{

    public function calculateSalary(int $base, int $overTime, int $bonusRate, int $deduction): float
    {
        return $base + $overTime - $deduction;
    }
}
