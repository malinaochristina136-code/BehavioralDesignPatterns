<?php
declare(strict_types=1);

require_once __DIR__ . '/QueryParser.php';

echo "=== INTERPRETER PATTERN: Student Search/Query System ===\n\n";

$students = [
    ['id' => '2026-001', 'name' => 'Juan',   'program' => 'BSIT', 'year' => 3],
    ['id' => '2026-002', 'name' => 'Maria',  'program' => 'BSCS', 'year' => 4],
    ['id' => '2026-003', 'name' => 'Pedro',  'program' => 'BSIT', 'year' => 1],
    ['id' => '2026-004', 'name' => 'Ana',    'program' => 'BSIT', 'year' => 4],
    ['id' => '2026-005', 'name' => 'Liza',   'program' => 'BSBA', 'year' => 2],
];

$queries = [
    "program = BSIT",
    "program = BSIT AND year >= 3",
    "year = 4 OR program = BSBA",
    "program = BSIT AND year > 1 OR name = Liza",
    "program != BSIT",
    "gpa > 1",
];

$parser = new QueryParser();

foreach ($queries as $query) {
    echo "Query: $query\n";

    try {
        $expression = $parser->parse($query);
        $found = 0;
        foreach ($students as $student) {
            if ($expression->interpret($student)) {
                echo "  {$student['id']} - {$student['name']} ({$student['program']}, Year {$student['year']})\n";
                $found++;
            }
        }
        if ($found === 0) {
            echo "  No matches.\n";
        }
    } catch (InvalidArgumentException $e) {
        echo "  Error: {$e->getMessage()}\n";
    }

    echo "\n";
}
