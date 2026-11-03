<?php
declare(strict_types=1);

require_once __DIR__ . '/ClassroomChat.php';

echo "=== MEDIATOR PATTERN: Student Communication System ===\n\n";

$chat = new ClassroomChat('IT-301 Chat Room');

$juan   = new Student('Juan');
$maria  = new Student('Maria');
$teacher = new Teacher('Mr. Cruz');
$admin  = new Admin('Registrar');

foreach ([$juan, $maria, $teacher, $admin] as $person) {
    $chat->register($person);
}

echo "\n--- Group messages ---\n";
$teacher->send('Quiz on Friday. Please review the design patterns.');
$juan->send('Will the quiz cover the Observer pattern?');

echo "\n--- Private messages ---\n";
$teacher->sendTo('Juan', 'Yes, Observer and Memento will be included.');
$maria->sendTo('Registrar', 'May I request a copy of my enrollment form?');
$admin->sendTo('Pedro', 'Hello?');
