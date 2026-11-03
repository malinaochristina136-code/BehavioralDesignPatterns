<?php
declare(strict_types=1);

interface EnrollmentState
{
    public function getName(): string;

    public function approve(StudentEnrollment $ctx): void;

    public function suspend(StudentEnrollment $ctx): void;

    public function reinstate(StudentEnrollment $ctx): void;

    public function withdraw(StudentEnrollment $ctx): void;

    public function graduate(StudentEnrollment $ctx): void;
}
