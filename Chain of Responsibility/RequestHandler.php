<?php
declare(strict_types=1);

require_once __DIR__ . '/StudentRequest.php';

abstract class RequestHandler
{
    private ?RequestHandler $next = null;

    public function setNext(RequestHandler $handler): RequestHandler
    {
        $this->next = $handler;
        return $handler;
    }

    public function handle(StudentRequest $request): void
    {
        if ($this->canHandle($request)) {
            $this->process($request);
            return;
        }

        if ($this->next !== null) {
            echo "  {$this->getName()}: not my area, passing it on...\n";
            $this->next->handle($request);
            return;
        }

        echo "  {$this->getName()}: no one in the chain can handle '{$request->getType()}'.\n";
    }

    abstract protected function getName(): string;

    abstract protected function canHandle(StudentRequest $request): bool;

    abstract protected function process(StudentRequest $request): void;
}
