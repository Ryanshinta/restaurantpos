<?php
namespace App\Services\Strategy;

use App\Services\Strategy\SalaryStrategy;

class Context
{
    private SalaryStrategy $salaryStrategy;

    public function __construct(SalaryStrategy $salaryStrategy)
    {
        $this->salaryStrategy = $salaryStrategy;
    }

    public function execute(int $a, int $b, int $c, int $d): float
    {
        return $this->salaryStrategy->calculateSalary($a,$b,$c,$d);
    }
}
