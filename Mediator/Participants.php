<?php
declare(strict_types=1);

require_once __DIR__ . '/ChatMediator.php';

abstract class Participant
{
    protected ChatMediator $mediator;

    public function __construct(protected string $name)
    {
    }

    public function setMediator(ChatMediator $mediator): void
    {
        $this->mediator = $mediator;
    }

    public function getName(): string
    {
        return $this->name;
    }

    abstract public function getRole(): string;

    public function send(string $message): void
    {
        echo "{$this->getRole()} {$this->name} (to everyone): $message\n";
        $this->mediator->broadcast($message, $this);
    }

    public function sendTo(string $recipientName, string $message): void
    {
        echo "{$this->getRole()} {$this->name} (to $recipientName): $message\n";
        $this->mediator->sendPrivate($message, $this, $recipientName);
    }

    public function receive(string $message, Participant $from): void
    {
        echo "    -> {$this->name} received from {$from->getName()}: $message\n";
    }
}

class Student extends Participant
{
    public function getRole(): string
    {
        return '[Student]';
    }
}

class Teacher extends Participant
{
    public function getRole(): string
    {
        return '[Teacher]';
    }
}

class Admin extends Participant
{
    public function getRole(): string
    {
        return '[Admin]';
    }
}
