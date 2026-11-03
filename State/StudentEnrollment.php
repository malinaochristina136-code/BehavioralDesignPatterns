<?php
declare(strict_types=1);

require_once __DIR__ . '/States.php';

class StudentEnrollment
{
    private EnrollmentState $state;

    public function __construct(private string $studentName)
    {
        $this->state = new PendingState();
    }

    public function setState(EnrollmentState $state): void
    {
        echo sprintf("      status: %s -> %s\n", $this->state->getName(), $state->getName());
        $this->state = $state;
    }

    public function getStatus(): string
    {
        return $this->state->getName();
    }

    public function getStudentName(): string
    {
        return $this->studentName;
    }

    public function approve(): void
    {
        $this->state->approve($this);
    }

    public function suspend(): void
    {
        $this->state->suspend($this);
    }

    public function reinstate(): void
    {
        $this->state->reinstate($this);
    }

    public function withdraw(): void
    {
        $this->state->withdraw($this);
    }

    public function graduate(): void
    {
        $this->state->graduate($this);
    }
}
