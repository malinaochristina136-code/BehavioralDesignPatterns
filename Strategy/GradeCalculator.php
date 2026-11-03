<?php
declare(strict_types=1);

require_once __DIR__ . '/Strategies.php';

class GradeCalculator
{
    public function __construct(private GradingStrategy $strategy)
    {
    }

    public function setStrategy(GradingStrategy $strategy): void
    {
        $this->strategy = $strategy;
    }

    public function compute(array $scores): float
    {
        return $this->strategy->calculate($scores);
    }

    public function getStrategyName(): string
    {
        return $this->strategy->getName();
    }
}
