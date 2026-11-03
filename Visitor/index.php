<?php
declare(strict_types=1);

require_once __DIR__ . '/Visitors.php';

echo "=== VISITOR PATTERN: Student Record Operations ===\n\n";

$records = (new StudentRecordCollection())
    ->add(new GradeRecord('Programming 2', 92.0, 3))
    ->add(new GradeRecord('Database Systems', 71.0, 3))
    ->add(new GradeRecord('Web Development', 88.0, 2))
    ->add(new AttendanceRecord('Programming 2', 28, 2))
    ->add(new AttendanceRecord('Database Systems', 20, 10))
    ->add(new PaymentRecord('Tuition - 1st installment', 15000.00, true))
    ->add(new PaymentRecord('Laboratory fee', 2500.00, false));

echo "1) Statistics\n";
$stats = new StatisticsVisitor();
$records->accept($stats);
$stats->printReport();

echo "\n2) CSV export\n";
$csv = new CsvExportVisitor();
$records->accept($csv);
echo $csv->getOutput();

echo "\n3) Alerts\n";
$alerts = new AlertVisitor();
$records->accept($alerts);
$alerts->printAlerts();
