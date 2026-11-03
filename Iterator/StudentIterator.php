<?php
declare(strict_types=1);

require_once __DIR__ . '/Student.php';

/**
 * Concrete Iterator: walks the collection's students one at a time.
 * It holds its own copy of the list, so the client never touches the
 * collection's internal array.
 */
class StudentIterator implements Iterator
{
    private int $position = 0;

    /** @param Student[] $students */
    public function __construct(private array $students)
    {
    }

    public function current(): Student
    {
        return $this->students[$this->position];
    }

    public function key(): int
    {
        return $this->position;
    }

    public function next(): void
    {
        $this->position++;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function valid(): bool
    {
        return isset($this->students[$this->position]);
    }
}
