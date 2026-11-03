<?php
declare(strict_types=1);

require_once __DIR__ . '/GradeCalculator.php';

echo "=== STRATEGY PATTERN: Grade Calculation System ===\n\n";

$scores = ['quiz' => 78, 'midterm' => 85, 'final' => 92];

echo "Scores: quiz=78, midterm=85, final=92\n\n";

$calculator = new GradeCalculator(new AverageStrategy());

$strategies = [
    new AverageStrategy(),
    new WeightedStrategy(),
    new DropLowestStrategy(),
    new CurvedStrategy(5),
];

foreach ($strategies as $strategy) {
    $calculator->setStrategy($strategy);   // swap behavior at runtime
    echo sprintf("%-50s %6.2f\n", $calculator->getStrategyName(), $calculator->compute($scores));
}
