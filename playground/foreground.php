<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Macocci7\BashColorizer\Enums\Foreground;
use Macocci7\BashColorizer\Colorizer;

Colorizer::background('blue')
    ->echo(' Available Foreground Colors ', PHP_EOL);

Colorizer::attributes(['reset'])
    ->background('default');

foreach (Foreground::values() as $i => $f) {
    echo sprintf(
        "%2d: %s",
        $i + 1,
        Colorizer::foreground($f)
            ->background($i === 0 ? "white" : "black")
            ->encode($f, PHP_EOL)
    );
}
