<?php
declare(strict_types=1);

class StudentRequest
{
    public function __construct(
        private string $studentName,
        private string $type,
        private string $details = ''
    ) {
    }

    public function getStudentName(): string
    {
        return $this->studentName;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getDetails(): string
    {
        return $this->details;
    }
}
