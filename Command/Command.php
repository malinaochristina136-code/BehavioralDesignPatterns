<?php
declare(strict_types=1);

interface Command
{
    public function execute(): void;

    public function undo(): void;

    public function describe(): string;
}
