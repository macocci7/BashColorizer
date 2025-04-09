<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Macocci7\BashColorizer\Enums\Attribute;
use Macocci7\BashColorizer\Enums\Foreground;
use Macocci7\BashColorizer\Enums\Background;
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
Colorizer::attributes($attributes)->echo('Attributes changed!', PHP_EOL);

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

/*
$attribute = Attribute::Bold;
$fgcolor = Foreground::Red;
$bgcolor = Background::Blue;

var_dump($attribute->code());
var_dump(Attribute::Italic->code());
var_dump(Attribute::Blink->name);
var_dump(Attribute::Underline->value);
var_dump(Attribute::from("reverse"));

var_dump($fgcolor->code());
var_dump(Foreground::Blue->code());
var_dump(Foreground::Green->name);
var_dump(Foreground::Yellow->value);
var_dump(Foreground::from("cyan"));

var_dump($bgcolor->code());
var_dump(Background::Blue->code());
var_dump(Background::Green->name);
var_dump(Background::Yellow->value);
var_dump(Background::from("cyan"));
*/
