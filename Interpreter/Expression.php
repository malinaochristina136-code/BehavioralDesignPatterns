<?php
declare(strict_types=1);

interface Expression
{
    public function interpret(array $student): bool;
}
