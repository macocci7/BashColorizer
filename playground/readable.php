<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Macocci7\BashColorizer\Colorizer;

echo Colorizer::attributes(["bold"])
    ->background([255, 255, 0])
    ->foreground([0, 128, 255])
    ->readable('Hi, there!', PHP_EOL);
