<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Macocci7\BashColorizer\Enums\Background;
use Macocci7\BashColorizer\Colorizer;

Colorizer::background('blue')
    ->echo(' Available Background Colors ', PHP_EOL);

Colorizer::attributes(['reset'])
    ->background('default');

foreach (Background::values() as $i => $b) {
    echo sprintf(
        "%2d: %s",
        $i + 1,
        Colorizer::background($b)
            ->foreground($i === 7 ? "black" : "white")
            ->encode($b, PHP_EOL)
    );
}
