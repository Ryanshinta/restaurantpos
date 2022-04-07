<?php

namespace App\Services\Strategy;
interface SalaryStrategy
{
    public function calculateSalary(int $base, int $overTime, int $bonusRate, int $deduction): float;
}
