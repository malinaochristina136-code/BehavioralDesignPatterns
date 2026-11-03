<?php
declare(strict_types=1);

require_once __DIR__ . '/StudentEnrollment.php';

echo "=== STATE PATTERN: Student Enrollment Status ===\n\n";

$enrollment = new StudentEnrollment('Juan Dela Cruz');
echo "Student: {$enrollment->getStudentName()} | Status: {$enrollment->getStatus()}\n\n";

echo "Try to graduate while Pending:\n";
$enrollment->graduate();

echo "\nApprove application:\n";
$enrollment->approve();

echo "\nSuspend, then try to graduate:\n";
$enrollment->suspend();
$enrollment->graduate();

echo "\nReinstate and graduate:\n";
$enrollment->reinstate();
$enrollment->graduate();

echo "\nTry to withdraw after graduation:\n";
$enrollment->withdraw();

echo "\nFinal status: {$enrollment->getStatus()}\n\n";

echo "--- Second student: withdraws early ---\n";
$second = new StudentEnrollment('Ana Reyes');
$second->approve();
$second->withdraw();
$second->reinstate();
echo "Final status: {$second->getStatus()}\n";
