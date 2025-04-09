<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Macocci7\BashColorizer\Enums\Attribute;
use Macocci7\BashColorizer\Enums\Foreground;
use Macocci7\BashColorizer\Colorizer;

$colors = [
    ...array_filter(
        Foreground::values(), function ($v, $k) {
            return ! in_array($k, [0, 8, 9]);
        }, 
        ARRAY_FILTER_USE_BOTH
    )
];
$n = count($colors);

Colorizer::background('blue')
    ->echo(' Available Attributes ', PHP_EOL);

Colorizer::attributes(['reset'])
    ->background('default');

foreach (Attribute::values() as $i => $a) {
    echo sprintf(
        "%2d: %s",
        $i + 1,
        Colorizer::foreground($colors[$i % $n])
            ->attributes([$a])  // this aplies the attribute
            ->encode($a, PHP_EOL)
    );
}
