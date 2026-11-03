<?php
declare(strict_types=1);

interface ChatMediator
{
    public function register(Participant $participant): void;

    public function broadcast(string $message, Participant $sender): void;

    public function sendPrivate(string $message, Participant $sender, string $recipientName): void;
}
