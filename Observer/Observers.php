<?php
declare(strict_types=1);

require_once __DIR__ . '/Observer.php';

class StudentPortal implements Observer
{
    public function update(float $grade): void
    {
        echo "Student Portal:\nNew grade posted.\n";
    }
}

class EmailNotification implements Observer
{
    public function update(float $grade): void
    {
        echo "Email Notification:\nYour grade has been updated.\n";
    }
}

class ParentNotification implements Observer
{
    public function update(float $grade): void
    {
        echo "Parent Notification:\nStudent grade has been posted.\n";
    }
}
class SmsNotification implements Observer
{
    public function update(float $grade): void
    {
        echo "SMS Notification:\nGrade alert: your new grade is " . number_format($grade, 2) . ".\n";
    }
}
