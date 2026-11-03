<?php
declare(strict_types=1);

interface Observer
{
    public function update(float $grade): void;
}
