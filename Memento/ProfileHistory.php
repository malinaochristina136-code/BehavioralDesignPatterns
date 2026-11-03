<?php
declare(strict_types=1);

require_once __DIR__ . '/StudentProfile.php';

class ProfileHistory
{
    private array $history = [];

    public function __construct(private StudentProfile $profile)
    {
    }

    public function save(): void
    {
        $this->history[] = $this->profile->createMemento();
    }

    public function canUndo(): bool
    {
        return !empty($this->history);
    }

    public function undo(): bool
    {
        if (!$this->canUndo()) {
            echo "Nothing to undo.\n";
            return false;
        }

        $this->profile->restore(array_pop($this->history));
        return true;
    }
}
