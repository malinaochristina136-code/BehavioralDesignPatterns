<?php
declare(strict_types=1);

abstract class Report
{
    protected const LINE = "========================";

    final public function generateReport(): void
    {
        $this->generateHeader();
        $data = $this->retrieveData();
        $this->formatData($data);
        $this->generateFooter();
    }

    protected function generateHeader(): void
    {
        echo self::LINE . "\n";
        echo $this->getTitle() . "\n";
        echo self::LINE . "\n";
    }

    protected function generateFooter(): void
    {
        echo self::LINE . "\n";
        echo "END OF REPORT\n";
        echo self::LINE . "\n";
    }

    abstract protected function getTitle(): string;

    abstract protected function retrieveData(): array;

    abstract protected function formatData(array $data): void;
}
