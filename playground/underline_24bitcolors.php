<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Macocci7\BashColorizer\Colorizer;

$interval = 64;
$column = 5;
$i = 0;

for ($r = 0; $r <= 256; $r += $interval) {
    for ($g = 0; $g <= 256; $g += $interval) {
        for ($b = 0; $b <= 256; $b += $interval) {
            $i = ($i + 1) % $column;
            $rr = $r < 0 ? 0 : ($r > 255 ? 255 : $r);
            $gg = $g < 0 ? 0 : ($g > 255 ? 255 : $g);
            $bb = $b < 0 ? 0 : ($b > 255 ? 255 : $b);
            $s = sprintf(' [%3d;%3d;%3d] ', $rr, $gg, $bb);
            Colorizer::underline([$rr, $gg, $bb])
                ->echo($s, !$i ? PHP_EOL : '');
        }
    }
}
