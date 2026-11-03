<?php
declare(strict_types=1);

require_once __DIR__ . '/StudentCollection.php';

$students = new StudentCollection();
$students->add(new Student("2026-001", "Juan"));
$students->add(new Student("2026-002", "Maria"));
$students->add(new Student("2026-003", "Pedro"));

echo "Student List\n";
foreach ($students as $student) {
    echo $student->getId() . " - " . $student->getName() . "\n";
}

echo "\nTotal students: " . count($students) . "\n";

echo "\nUsing the iterator manually:\n";
$iterator = $students->getIterator();
while ($iterator->valid()) {
    echo ($iterator->key() + 1) . ". " . $iterator->current()->getName() . "\n";
    $iterator->next();
}
