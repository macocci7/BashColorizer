<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Macocci7\BashColorizer\Colorizer;

$config = [
    'attributes' => ['italic', 'bold'],
    'foreground' => 'black',
    'background' => 'green',
];
$string = " Hi, there! ";

// Static calls
Colorizer::echo($string);

Colorizer::config($config);
Colorizer::echo($string);

Colorizer::foreground('yellow');
Colorizer::background('red');
Colorizer::echo($string, PHP_EOL);

Colorizer::background('blue');
Colorizer::echo($string, PHP_EOL);

// method chains
$attributes = ['strike', 'double-underline'];
Colorizer::attributes($attributes)
    ->foreground("green")
    ->background("black")
    ->echo('Attributes changed!', PHP_EOL);

// creating an instance
$colorizer = new Colorizer;
$colorizer->echo("No config.", "<br />\n\n");

// this is also available
$config = [
    'attributes' => ['reverse'],
    'foreground' => 'magenta',
    'background' => 'yellow',
];
$colorizer = new Colorizer($config);

$colorizer->config($config)->echo($string,  "<br />\n\n");

$colorizer = Colorizer::attributes($attributes);
$colorizer->echo("Attributes changed.", PHP_EOL);
