<?php
declare(strict_types=1);

final class StudentProfileMemento
{
    public function __construct(
        private readonly string $name,
        private readonly string $program,
        private readonly int $year,
        private readonly string $email
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getProgram(): string
    {
        return $this->program;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
