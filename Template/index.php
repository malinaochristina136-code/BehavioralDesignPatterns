<?php
declare(strict_types=1);

require_once __DIR__ . '/Reports.php';

$reports = [
    new StudentReport(),
    new GradeReport(),
    new EnrollmentReport(),
];

foreach ($reports as $report) {
    $report->generateReport();
    echo "\n";
}
