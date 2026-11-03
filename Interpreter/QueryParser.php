<?php
declare(strict_types=1);

require_once __DIR__ . '/Expressions.php';

class QueryParser
{
    public function parse(string $query): Expression
    {
        $orParts = preg_split('/\s+OR\s+/i', trim($query));
        $expr = $this->parseAnd(array_shift($orParts));

        foreach ($orParts as $part) {
            $expr = new OrExpression($expr, $this->parseAnd($part));
        }

        return $expr;
    }

    private function parseAnd(string $text): Expression
    {
        $andParts = preg_split('/\s+AND\s+/i', trim($text));
        $expr = $this->parseCondition(array_shift($andParts));

        foreach ($andParts as $part) {
            $expr = new AndExpression($expr, $this->parseCondition($part));
        }

        return $expr;
    }

    private function parseCondition(string $text): Expression
    {
        if (!preg_match('/^(\w+)\s*(>=|<=|!=|=|>|<)\s*(.+)$/', trim($text), $m)) {
            throw new InvalidArgumentException("Invalid condition: '$text'");
        }

        return new ConditionExpression(strtolower($m[1]), $m[2], trim($m[3], " '\""));
    }
}
