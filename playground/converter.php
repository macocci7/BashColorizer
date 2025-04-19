<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Macocci7\BashColorizer\Colorizer;
use Macocci7\BashColorizer\Converter;

// hex to rgb
$hex = '#abcdef';
$rgb = Converter::decimal($hex);

echo sprintf(
    "%s => [%s, %s, %s]\n",
    Colorizer::foreground($hex)->encode($hex),
    Colorizer::foreground('red')->encode($rgb[0]),
    Colorizer::foreground('green')->encode($rgb[1]),
    Colorizer::foreground('blue')->encode($rgb[2]),
);

// decimal to rgb
$rgb = [254, 220, 186];
$hex = Converter::hex($rgb);

echo sprintf(
    "[%s, %s, %s] => %s\n",
    Colorizer::foreground('red')->encode($rgb[0]),
    Colorizer::foreground('green')->encode($rgb[1]),
    Colorizer::foreground('blue')->encode($rgb[2]),
    Colorizer::foreground($hex)->encode($hex),
);
