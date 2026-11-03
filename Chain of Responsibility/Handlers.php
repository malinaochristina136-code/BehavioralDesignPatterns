<?php
declare(strict_types=1);

require_once __DIR__ . '/RequestHandler.php';

class RegistrarHandler extends RequestHandler
{
    private const TYPES = ['transcript', 'certificate', 'enrollment'];

    protected function getName(): string
    {
        return 'Registrar';
    }

    protected function canHandle(StudentRequest $request): bool
    {
        return in_array($request->getType(), self::TYPES, true);
    }

    protected function process(StudentRequest $request): void
    {
        echo "  Registrar: processed {$request->getType()} request for {$request->getStudentName()}.\n";
    }
}

class FinanceHandler extends RequestHandler
{
    private const TYPES = ['refund', 'payment-plan', 'scholarship'];

    protected function getName(): string
    {
        return 'Finance Office';
    }

    protected function canHandle(StudentRequest $request): bool
    {
        return in_array($request->getType(), self::TYPES, true);
    }

    protected function process(StudentRequest $request): void
    {
        echo "  Finance Office: reviewed {$request->getType()} for {$request->getStudentName()} ({$request->getDetails()}).\n";
    }
}

class DeanHandler extends RequestHandler
{
    private const TYPES = ['grade-appeal', 'leave-of-absence', 'program-shift'];

    protected function getName(): string
    {
        return 'Dean';
    }

    protected function canHandle(StudentRequest $request): bool
    {
        return in_array($request->getType(), self::TYPES, true);
    }

    protected function process(StudentRequest $request): void
    {
        echo "  Dean: decided on {$request->getType()} for {$request->getStudentName()} ({$request->getDetails()}).\n";
    }
}
