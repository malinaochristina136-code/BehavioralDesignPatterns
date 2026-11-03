<?php
declare(strict_types=1);

require_once __DIR__ . '/Commands.php';

class ActionInvoker
{
    /** @var Command[] */
    private array $history = [];

    public function run(Command $command): void
    {
        echo "  > {$command->describe()}\n";
        $command->execute();
        $this->history[] = $command;
    }

    public function undoLast(): void
    {
        if (empty($this->history)) {
            echo "  Nothing to undo.\n";
            return;
        }

        $command = array_pop($this->history);
        echo "  < Undo: {$command->describe()}\n";
        $command->undo();
    }

    public function showHistory(): void
    {
        echo "  Command history:\n";
        foreach ($this->history as $i => $command) {
            echo '    ' . ($i + 1) . '. ' . $command->describe() . "\n";
        }
    }
}
