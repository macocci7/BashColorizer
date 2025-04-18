<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Macocci7\BashColorizer\Colorizer;

$greeting = "Let's make your bash terminal full of colors!";

Colorizer::attributes(["bold"])
    ->echo(PHP_EOL)
    ->foreground("red")->echo("        B ")
    ->foreground("yellow")->echo("A ")
    ->foreground("white")->echo("S ")
    ->foreground("green")->echo("H   ")
    ->foreground("cyan")->echo("C ")
    ->foreground("blue")->echo("O ")
    ->foreground("magenta")->echo("L ")
    ->foreground("black")->echo("O ")
    ->foreground("red")->echo("R ")
    ->foreground("yellow")->echo("I ")
    ->foreground("white")->echo("Z ")
    ->foreground("green")->echo("E ")
    ->foreground("cyan")->echo("R", PHP_EOL)
    ->echo(PHP_EOL)
    ;
Colorizer::attributes(["reset"])
    ->foreground("white")->background("black")->echo($greeting, PHP_EOL)
    ->foreground("green")->background("red")->echo($greeting, PHP_EOL)
    ->foreground("green")->background("yellow")->echo($greeting, PHP_EOL)
    ->foreground("green")->background("white")->echo($greeting, PHP_EOL)
    ->foreground("green")->background("green")->echo($greeting, PHP_EOL)
    ->foreground("green")->background("cyan")->echo($greeting, PHP_EOL)
    ->foreground("green")->background("blue")->echo($greeting, PHP_EOL)
    ->foreground("green")->background("magenta")->echo($greeting, PHP_EOL)
    ->echo('', PHP_EOL)
    ;
