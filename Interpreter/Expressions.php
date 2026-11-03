<?php
declare(strict_types=1);

require_once __DIR__ . '/Expression.php';

class ConditionExpression implements Expression
{
    public function __construct(
        private string $field,
        private string $operator,
        private string $value
    ) {
    }

    public function interpret(array $student): bool
    {
        if (!array_key_exists($this->field, $student)) {
            throw new InvalidArgumentException("Unknown field '{$this->field}'");
        }

        $actual = $student[$this->field];

        if (is_numeric($actual) && is_numeric($this->value)) {
            $cmp = (float)$actual <=> (float)$this->value;
        } else {
            $cmp = strcasecmp((string)$actual, $this->value);
        }

        return match ($this->operator) {
            '='  => $cmp === 0,
            '!=' => $cmp !== 0,
            '>'  => $cmp > 0,
            '<'  => $cmp < 0,
            '>=' => $cmp >= 0,
            '<=' => $cmp <= 0,
            default => throw new InvalidArgumentException("Unknown operator '{$this->operator}'"),
        };
    }
}

class AndExpression implements Expression
{
    public function __construct(private Expression $left, private Expression $right)
    {
    }

    public function interpret(array $student): bool
    {
        return $this->left->interpret($student) && $this->right->interpret($student);
    }
}

class OrExpression implements Expression
{
    public function __construct(private Expression $left, private Expression $right)
    {
    }

    public function interpret(array $student): bool
    {
        return $this->left->interpret($student) || $this->right->interpret($student);
    }
}
