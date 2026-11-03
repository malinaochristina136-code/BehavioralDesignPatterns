<?php
declare(strict_types=1);

require_once __DIR__ . '/Handlers.php';

echo "=== CHAIN OF RESPONSIBILITY: Student Request Processing System ===\n\n";

$registrar = new RegistrarHandler();
$registrar->setNext(new FinanceHandler())
          ->setNext(new DeanHandler());

$requests = [
    new StudentRequest('Juan Dela Cruz', 'transcript'),
    new StudentRequest('Maria Santos', 'refund', 'PHP 2,500 lab fee'),
    new StudentRequest('Pedro Reyes', 'grade-appeal', 'Database Systems'),
    new StudentRequest('Ana Lopez', 'parking-permit'),
];

foreach ($requests as $request) {
    echo "Request: {$request->getType()} from {$request->getStudentName()}\n";
    $registrar->handle($request);
    echo "\n";
}
