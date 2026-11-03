<?php
declare(strict_types=1);

interface GradingStrategy
{
    public function calculate(array $scores): float;

    public function getName(): string;
}
