<?php
declare(strict_types=1);

require_once __DIR__ . '/Participants.php';

class ClassroomChat implements ChatMediator
{
    private array $participants = [];

    public function __construct(private string $roomName)
    {
    }

    public function register(Participant $participant): void
    {
        $participant->setMediator($this);
        $this->participants[$participant->getName()] = $participant;
        echo "{$participant->getName()} joined {$this->roomName}.\n";
    }

    public function broadcast(string $message, Participant $sender): void
    {
        foreach ($this->participants as $participant) {
            if ($participant !== $sender) {
                $participant->receive($message, $sender);
            }
        }
    }

    public function sendPrivate(string $message, Participant $sender, string $recipientName): void
    {
        if (!isset($this->participants[$recipientName])) {
            echo "    [!] '$recipientName' is not in {$this->roomName}.\n";
            return;
        }

        $this->participants[$recipientName]->receive($message, $sender);
    }
}
