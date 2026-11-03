<?php
declare(strict_types=1);

require_once __DIR__ . '/Subject.php';

class GradeSystem implements Subject
{
    private array $observers = [];
    private float $grade = 0.0;

    public function attach(Observer $observer): void
    {
        $this->observers[] = $observer;
    }

    public function detach(Observer $observer): void
    {
        $this->observers = array_values(
            array_filter($this->observers, fn(Observer $o) => $o !== $observer)
        );
    }

    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this->grade);
        }
    }

    public function updateGrade(float $grade): void
    {
        $this->grade = $grade;
        echo "Grade updated: " . number_format($grade, 2) . "\n";
        $this->notify();
    }
}
