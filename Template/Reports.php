<?php
declare(strict_types=1);

require_once __DIR__ . '/Report.php';

class StudentReport extends Report
{
    protected function getTitle(): string
    {
        return "STUDENT REPORT";
    }

    protected function retrieveData(): array
    {
        // Stand-in for a database query.
        return ['id' => '2026-001', 'name' => 'Juan Dela Cruz', 'program' => 'BSIT'];
    }

    protected function formatData(array $data): void
    {
        echo "Student ID: {$data['id']}\n";
        echo "Name: {$data['name']}\n";
        echo "Program: {$data['program']}\n";
    }
}

class GradeReport extends Report
{
    protected function getTitle(): string
    {
        return "GRADE REPORT";
    }

    protected function retrieveData(): array
    {
        return [
            'name' => 'Juan Dela Cruz',
            'grades' => ['Programming 2' => 1.25, 'Database Systems' => 1.75, 'Web Development' => 1.50],
        ];
    }

    protected function formatData(array $data): void
    {
        echo "Name: {$data['name']}\n";
        foreach ($data['grades'] as $subject => $grade) {
            echo sprintf("%-18s %.2f\n", $subject, $grade);
        }
        echo sprintf("%-18s %.2f\n", 'Average', array_sum($data['grades']) / count($data['grades']));
    }
}

class EnrollmentReport extends Report
{
    protected function getTitle(): string
    {
        return "ENROLLMENT REPORT";
    }

    protected function retrieveData(): array
    {
        return [
            'id' => '2026-001',
            'name' => 'Juan Dela Cruz',
            'term' => '1st Semester 2026-2027',
            'status' => 'Enrolled',
            'units' => 21,
        ];
    }

    protected function formatData(array $data): void
    {
        echo "Student ID: {$data['id']}\n";
        echo "Name: {$data['name']}\n";
        echo "Term: {$data['term']}\n";
        echo "Status: {$data['status']}\n";
        echo "Units: {$data['units']}\n";
    }
}
