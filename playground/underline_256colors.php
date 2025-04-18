<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Macocci7\BashColorizer\Colorizer;

$columns = 16;
for ($i = 0; $i < 256; $i++) {
    $s = sprintf(" %3d ", $i);
    $eol = ($i % $columns) === ($columns - 1) ? PHP_EOL : '';
    Colorizer::underline($i)->echo($s, $eol);
}
