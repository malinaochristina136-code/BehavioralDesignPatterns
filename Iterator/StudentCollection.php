<?php
declare(strict_types=1);

require_once __DIR__ . '/StudentIterator.php';

/**
 * Aggregate: the internal array is private, and the only way to read
 * the students is through an iterator (foreach works via IteratorAggregate).
 */
class StudentCollection implements IteratorAggregate, Countable
{
    /** @var Student[] */
    private array $students = [];

    public function add(Student $student): void
    {
        $this->students[] = $student;
    }

    public function count(): int
    {
        return count($this->students);
    }

    public function getIterator(): StudentIterator
    {
        return new StudentIterator($this->students);
    }
}
