<?php
declare(strict_types=1);

require_once __DIR__ . '/ActionInvoker.php';

echo "=== COMMAND PATTERN: Student Action/Command System ===\n\n";

$account = new StudentAccount('Juan Dela Cruz', 18000.00);
$invoker = new ActionInvoker();

echo "Start:\n";
$account->status();

echo "\nPerforming actions:\n";
$invoker->run(new EnrollSubjectCommand($account, 'Programming 2'));
$invoker->run(new EnrollSubjectCommand($account, 'Database Systems'));
$invoker->run(new PayFeeCommand($account, 5000.00));
$invoker->run(new DropSubjectCommand($account, 'Programming 2'));
$account->status();

echo "\n";
$invoker->showHistory();

echo "\nUndoing the last two actions:\n";
$invoker->undoLast();
$invoker->undoLast();
$account->status();

echo "\nUndo everything else:\n";
$invoker->undoLast();
$invoker->undoLast();
$invoker->undoLast();
$account->status();
