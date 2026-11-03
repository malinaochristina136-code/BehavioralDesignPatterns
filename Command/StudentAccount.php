<?php
declare(strict_types=1);

class StudentAccount
{
    /** @var string[] */
    private array $subjects = [];
    private float $balance = 0.0;

    public function __construct(private string $name, float $balance)
    {
        $this->balance = $balance;
    }

    public function enroll(string $subject): void
    {
        $this->subjects[] = $subject;
    }

    public function drop(string $subject): void
    {
        $this->subjects = array_values(array_diff($this->subjects, [$subject]));
    }

    public function pay(float $amount): void
    {
        $this->balance -= $amount;
    }

    public function refund(float $amount): void
    {
        $this->balance += $amount;
    }

    public function hasSubject(string $subject): bool
    {
        return in_array($subject, $this->subjects, true);
    }

    public function status(): void
    {
        $subjects = $this->subjects ? implode(', ', $this->subjects) : '(none)';
        echo sprintf("  [%s] Subjects: %s | Balance due: PHP %s\n", $this->name, $subjects, number_format($this->balance, 2));
    }
}
