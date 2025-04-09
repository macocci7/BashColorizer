<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Macocci7\BashColorizer\Enums\Attribute;

//var_dump(Attribute::cases());
//var_dump(Attribute::names());
//var_dump(Attribute::values());
//var_dump(Attribute::asArray());
//var_dump(Attribute::codes());
echo "[" . PHP_EOL;
foreach (Attribute::codes() as $key => $code) {
    echo "    '{$key}' => {$code}," . PHP_EOL;
}
echo "];" . PHP_EOL;
