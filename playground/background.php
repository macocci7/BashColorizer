<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Macocci7\BashColorizer\Enums\Background;

//var_dump(Background::codes());
echo "[" . PHP_EOL;
foreach (Background::codes() as $key => $code) {
    echo "    '{$key}' => {$code}," . PHP_EOL;
}
echo "];" . PHP_EOL;
