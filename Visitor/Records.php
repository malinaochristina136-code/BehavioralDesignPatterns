<?php
declare(strict_types=1);

require_once __DIR__ . '/Visitor.php';

class GradeRecord implements StudentRecord
{
    public function __construct(
        public readonly string $subject,
        public readonly float $grade,
        public readonly int $units
    ) {
    }

    public function accept(RecordVisitor $visitor): void
    {
        $visitor->visitGrade($this);
    }
}

class AttendanceRecord implements StudentRecord
{
    public function __construct(
        public readonly string $subject,
        public readonly int $present,
        public readonly int $absent
    ) {
    }

    public function accept(RecordVisitor $visitor): void
    {
        $visitor->visitAttendance($this);
    }
}

class PaymentRecord implements StudentRecord
{
    public function __construct(
        public readonly string $description,
        public readonly float $amount,
        public readonly bool $paid
    ) {
    }

    public function accept(RecordVisitor $visitor): void
    {
        $visitor->visitPayment($this);
    }
}

class StudentRecordCollection
{
    private array $records = [];

    public function add(StudentRecord $record): self
    {
        $this->records[] = $record;
        return $this;
    }

    public function accept(RecordVisitor $visitor): void
    {
        foreach ($this->records as $record) {
            $record->accept($visitor);
        }
    }
}
