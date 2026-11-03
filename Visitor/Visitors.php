<?php
declare(strict_types=1);

require_once __DIR__ . '/Records.php';

class StatisticsVisitor implements RecordVisitor
{
    private float $weightedPoints = 0;
    private int $totalUnits = 0;
    private int $present = 0;
    private int $absent = 0;
    private float $balance = 0;

    public function visitGrade(GradeRecord $record): void
    {
        $this->weightedPoints += $record->grade * $record->units;
        $this->totalUnits += $record->units;
    }

    public function visitAttendance(AttendanceRecord $record): void
    {
        $this->present += $record->present;
        $this->absent += $record->absent;
    }

    public function visitPayment(PaymentRecord $record): void
    {
        if (!$record->paid) {
            $this->balance += $record->amount;
        }
    }

    public function printReport(): void
    {
        $avg  = $this->totalUnits ? $this->weightedPoints / $this->totalUnits : 0;
        $days = $this->present + $this->absent;
        $rate = $days ? $this->present / $days * 100 : 0;
        echo sprintf("  Weighted average : %.2f\n", $avg);
        echo sprintf("  Attendance rate  : %.1f%%\n", $rate);
        echo sprintf("  Unpaid balance   : PHP %s\n", number_format($this->balance, 2));
    }
}
class CsvExportVisitor implements RecordVisitor
{
    private array $lines = ['type,detail,value1,value2'];

    public function visitGrade(GradeRecord $record): void
    {
        $this->lines[] = "grade,{$record->subject},{$record->grade},{$record->units}";
    }

    public function visitAttendance(AttendanceRecord $record): void
    {
        $this->lines[] = "attendance,{$record->subject},{$record->present},{$record->absent}";
    }

    public function visitPayment(PaymentRecord $record): void
    {
        $status = $record->paid ? 'paid' : 'unpaid';
        $this->lines[] = "payment,{$record->description},{$record->amount},{$status}";
    }

    public function getOutput(): string
    {
        return implode("\n", $this->lines) . "\n";
    }
}

class AlertVisitor implements RecordVisitor
{
    private array $alerts = [];

    public function visitGrade(GradeRecord $record): void
    {
        if ($record->grade < 75) {
            $this->alerts[] = "Failing grade in {$record->subject} ({$record->grade})";
        }
    }

    public function visitAttendance(AttendanceRecord $record): void
    {
        $total = $record->present + $record->absent;
        if ($total > 0 && $record->absent / $total > 0.2) {
            $this->alerts[] = "High absences in {$record->subject} ({$record->absent}/{$total})";
        }
    }

    public function visitPayment(PaymentRecord $record): void
    {
        if (!$record->paid) {
            $this->alerts[] = "Unpaid: {$record->description} (PHP " . number_format($record->amount, 2) . ")";
        }
    }

    public function printAlerts(): void
    {
        if (!$this->alerts) {
            echo "  No alerts.\n";
            return;
        }
        foreach ($this->alerts as $alert) {
            echo "  [!] $alert\n";
        }
    }
}
