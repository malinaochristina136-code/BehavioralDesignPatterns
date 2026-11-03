<?php
declare(strict_types=1);

require_once __DIR__ . '/GradeSystem.php';
require_once __DIR__ . '/Observers.php';

$gradeSystem = new GradeSystem();

$gradeSystem->attach(new StudentPortal());
$gradeSystem->attach(new EmailNotification());
$gradeSystem->attach(new ParentNotification());

$gradeSystem->updateGrade(1.75);

echo "\n--- Adding SmsNotification (GradeSystem unchanged) ---\n";
$sms = new SmsNotification();
$gradeSystem->attach($sms);
$gradeSystem->updateGrade(1.50);

echo "\n--- Detaching SmsNotification ---\n";
$gradeSystem->detach($sms);
$gradeSystem->updateGrade(1.25);
