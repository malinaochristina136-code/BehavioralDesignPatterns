<?php
declare(strict_types=1);

require_once __DIR__ . '/EnrollmentState.php';

abstract class AbstractEnrollmentState implements EnrollmentState
{
    public function approve(StudentEnrollment $ctx): void
    {
        $this->deny('approve');
    }

    public function suspend(StudentEnrollment $ctx): void
    {
        $this->deny('suspend');
    }

    public function reinstate(StudentEnrollment $ctx): void
    {
        $this->deny('reinstate');
    }

    public function withdraw(StudentEnrollment $ctx): void
    {
        $this->deny('withdraw');
    }

    public function graduate(StudentEnrollment $ctx): void
    {
        $this->deny('graduate');
    }

    protected function deny(string $action): void
    {
        echo sprintf("  [x] Cannot %s while status is '%s'.\n", $action, $this->getName());
    }
}

class PendingState extends AbstractEnrollmentState
{
    public function getName(): string
    {
        return 'Pending';
    }

    public function approve(StudentEnrollment $ctx): void
    {
        echo "  [ok] Application approved. Student is now enrolled.\n";
        $ctx->setState(new EnrolledState());
    }

    public function withdraw(StudentEnrollment $ctx): void
    {
        echo "  [ok] Application withdrawn before approval.\n";
        $ctx->setState(new WithdrawnState());
    }
}

class EnrolledState extends AbstractEnrollmentState
{
    public function getName(): string
    {
        return 'Enrolled';
    }

    public function suspend(StudentEnrollment $ctx): void
    {
        echo "  [ok] Student suspended.\n";
        $ctx->setState(new SuspendedState());
    }

    public function withdraw(StudentEnrollment $ctx): void
    {
        echo "  [ok] Student withdrew from the program.\n";
        $ctx->setState(new WithdrawnState());
    }

    public function graduate(StudentEnrollment $ctx): void
    {
        echo "  [ok] Requirements complete. Student graduated!\n";
        $ctx->setState(new GraduatedState());
    }
}

class SuspendedState extends AbstractEnrollmentState
{
    public function getName(): string
    {
        return 'Suspended';
    }

    public function reinstate(StudentEnrollment $ctx): void
    {
        echo "  [ok] Suspension lifted. Student is enrolled again.\n";
        $ctx->setState(new EnrolledState());
    }

    public function withdraw(StudentEnrollment $ctx): void
    {
        echo "  [ok] Student withdrew while suspended.\n";
        $ctx->setState(new WithdrawnState());
    }
}

class WithdrawnState extends AbstractEnrollmentState
{
    public function getName(): string
    {
        return 'Withdrawn';
    }
}

class GraduatedState extends AbstractEnrollmentState
{
    public function getName(): string
    {
        return 'Graduated';
    }
}
