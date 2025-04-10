<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Macocci7\BashColorizer\Colorizer;
use Macocci7\BashColorizer\Enums\Attribute;

$interval = 64;
$column = 5;
$i = 0;
$j = 0;
$attributes = [
    ...array_filter(
        Attribute::values(),
        function ($v, $k) {
            return ! in_array($k, [5, 6, 7, 8, 20, 23, 24, 25, 27, 28, 29]);
        },
        ARRAY_FILTER_USE_BOTH
    )
];
$na = count($attributes);

for ($r = 0; $r <= 256; $r += $interval) {
    for ($g = 0; $g <= 256; $g += $interval) {
        for ($b = 0; $b <= 256; $b += $interval) {
            $i = ($i + 1) % $column;
            $j = $i === 1 ? ($j + 1) % $na : $j;
            $rr = $r < 0 ? 0 : ($r > 255 ? 255 : $r);
            $gg = $g < 0 ? 0 : ($g > 255 ? 255 : $g);
            $bb = $b < 0 ? 0 : ($b > 255 ? 255 : $b);
            $s = sprintf(' [%3d;%3d;%3d] ', $rr, $gg, $bb);
            Colorizer::foreground([$rr, $gg, $bb])
                ->attributes([$attributes[$j]])
                ->echo($s, !$i ? PHP_EOL : '');
        }
    }
}
