<?php
declare(strict_types=1);

interface RecordVisitor
{
    public function visitGrade(GradeRecord $record): void;

    public function visitAttendance(AttendanceRecord $record): void;

    public function visitPayment(PaymentRecord $record): void;
}

interface StudentRecord
{
    public function accept(RecordVisitor $visitor): void;
}
