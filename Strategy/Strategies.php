<?php
declare(strict_types=1);

require_once __DIR__ . '/GradingStrategy.php';

class AverageStrategy implements GradingStrategy
{
    public function calculate(array $scores): float
    {
        return array_sum($scores) / count($scores);
    }

    public function getName(): string
    {
        return 'Simple Average';
    }
}

class WeightedStrategy implements GradingStrategy
{
    private const WEIGHTS = ['quiz' => 0.20, 'midterm' => 0.30, 'final' => 0.50];

    public function calculate(array $scores): float
    {
        $total = 0.0;
        foreach (self::WEIGHTS as $component => $weight) {
            $total += ($scores[$component] ?? 0) * $weight;
        }
        return $total;
    }

    public function getName(): string
    {
        return 'Weighted (Quiz 20% / Midterm 30% / Final 50%)';
    }
}

class DropLowestStrategy implements GradingStrategy
{
    public function calculate(array $scores): float
    {
        if (count($scores) > 1) {
            unset($scores[array_search(min($scores), $scores, true)]);
        }
        return array_sum($scores) / count($scores);
    }

    public function getName(): string
    {
        return 'Drop Lowest Score';
    }
}

class CurvedStrategy implements GradingStrategy
{
    public function __construct(private float $bonus = 5.0)
    {
    }

    public function calculate(array $scores): float
    {
        $average = array_sum($scores) / count($scores);
        return min(100.0, $average + $this->bonus);
    }

    public function getName(): string
    {
        return "Curved (+{$this->bonus} bonus, max 100)";
    }
}
