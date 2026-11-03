<?php
declare(strict_types=1);

require_once __DIR__ . '/ProfileHistory.php';

$profile = new StudentProfile("Juan Dela Cruz", "BSIT", 3, "juan@school.edu");
$history = new ProfileHistory($profile);

echo "Original Profile:\n";
$profile->display();

$history->save();
$profile->setProgram("BSCS");
$profile->setYear(4);

echo "\nCurrent Profile:\n";
$profile->display();

echo "\nUndo...\n";
$history->undo();

echo "\nRestored Profile:\n";
$profile->display();

echo "\n--- Multiple changes ---\n";
$history->save();
$profile->setEmail("juan.new@school.edu");
$history->save();
$profile->setName("Juan D. Cruz");

echo "\nAfter two edits:\n";
$profile->display();

echo "\nUndo...\n";
$history->undo();
$profile->display();

echo "\nUndo...\n";
$history->undo();
$profile->display();

echo "\nUndo...\n";
$history->undo();
