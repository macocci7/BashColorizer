<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Macocci7\BashColorizer\Enums\Foreground;

//var_dump(Foreground::codes());
echo "[" . PHP_EOL;
foreach (Foreground::codes() as $key => $code) {
    echo "    '{$key}' => {$code}," . PHP_EOL;
}
echo "];" . PHP_EOL;
