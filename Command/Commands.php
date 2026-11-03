<?php
declare(strict_types=1);

require_once __DIR__ . '/Command.php';
require_once __DIR__ . '/StudentAccount.php';

class EnrollSubjectCommand implements Command
{
    public function __construct(private StudentAccount $account, private string $subject)
    {
    }

    public function execute(): void
    {
        $this->account->enroll($this->subject);
    }

    public function undo(): void
    {
        $this->account->drop($this->subject);
    }

    public function describe(): string
    {
        return "Enroll in {$this->subject}";
    }
}

class DropSubjectCommand implements Command
{
    public function __construct(private StudentAccount $account, private string $subject)
    {
    }

    public function execute(): void
    {
        $this->account->drop($this->subject);
    }

    public function undo(): void
    {
        $this->account->enroll($this->subject);
    }

    public function describe(): string
    {
        return "Drop {$this->subject}";
    }
}

class PayFeeCommand implements Command
{
    public function __construct(private StudentAccount $account, private float $amount)
    {
    }

    public function execute(): void
    {
        $this->account->pay($this->amount);
    }

    public function undo(): void
    {
        $this->account->refund($this->amount);
    }

    public function describe(): string
    {
        return 'Pay PHP ' . number_format($this->amount, 2);
    }
}
