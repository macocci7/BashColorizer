# Bash Colorizer

Let's make your bash terminal full of colors!

## 1. Features

`Bash Colorizer` outputs strings in specified colors.

## 2. Contents

## 3. Requirement

- PHP 8.1 or later installed
- Composer v2 installed
- Bash v5 installed

## 4. Installation

```bash
composer require macocci7/bash-colorizer
```

## 5. Usage

### 5-1. Basic Usage

- Import composer's `autoload.php` at first.

    ```php
    <?php

    require_once __DIR__ . '/../vendor/autoload.php';
    ```

- Displaying messages:

    ```php
    use Macocci7\BashColorizer\Colorizer;

    // static calls
    Colorizer::echo("Hi, there!");
    Colorizer::echo(" How's it going with you?", PHP_EOL);

    // method chains
    Colorizer::echo("Hi, there!");
        ->echo(" How's it going with you?", PHP_EOL);

    // creating an instance
    $colorizer = new Colorizer;
    $colorizer->("Hi, there!")
        ->echo(" How's it going with you?", PHP_EOL);
    ```

- Configuration:

    static call:
    ```php
    $config = [
        'attributes' => ['italic', 'bold'],
        'foreground' => 'black',
        'background' => 'green',
    ];

    Colorizer::config($config);
    Colorizer::echo("Hi, there!");
    ```

    method chain:
    ```php
    Colorizer::config($config)
        ->echo("Hi, there!");
    ```

    creating an instance:
    ```php
    // several ways
    $colorizer = new Colorizer;
    $colorizer = new Colorizer($config);
    $colorizer = Colorizer::config($config);

    $colorizer->config($config)
        ->echo("Hi, there!")
        ->echo(" How's it going with you?", PHP_EOL);
    ```

- Setting attributes:

    ```php
    Colorizer::attributes(['underline', 'strike'])
        ->echo("Hi, there!", PHP_EOL);
    ```

- Setting foreground color:

    ```php
    Colorizer::foreground('green')
        ->echo("Hi, there!", PHP_EOL);
    ```

- Setting background color:

    ```php
    Colorizer::background("red")
        ->echo("Hi, there!", PHP_EOL);
    ```

- Equivalent to `config()`:

    ```php
    Colorizer::attributes(['double-underline', 'italic'])
        ->foreground("yellow")
        ->background("blue")
        ->echo("Hi, there!", PHP_EOL);
    ```

- Returning colorized string:

    ```php
    // as an argument of echo
    echo Colorizer::config($config)
        ->encode("Hi, there!") . PHP_EOL;

    // this is also effective
    echo sprintf(
        "%s: %s%s",
        $name,
        Colorizer::config($config)
            ->encode("Hi, there!"),
        PHP_EOL
    );
    ```

### 5-2. Available attributes:

- `reset`
- `bold`
- `faint`
- `italic`
- `underline`
- `blink`
- `fast-blink`
- `reverse`
- `conceal`
- `strike`
- `gothic`
- `double-underline`
- `normal`
- `no-italic`
- `no-underline`
- `no-blink`
- `no-reverse`
- `no-conceal`
- `no-strike`

e.g.) on VSCode Terminal

<img src="arts/available_attributes.png" width="180" height="360" />

### 5-3. Available colors:

`foreground`/`background`:

- `black`
- `red`
- `green`
- `yellow`
- `blue`
- `magenta`
- `cyan`
- `white`
- `extended`
- `default`


e.g.) on VSCode Terminal
|Foregound Colors|Background Colors|
|---|---|
|<img src="arts/available_foreground_colors.png" with="240" height="216" />|<img src="arts/available_background_colors.png" with="240" height="216" />|

## 6. EXamples

Example codes are in [playground](playground/) directory.

- [colorizer.php](playground/colorizer.php)
- [attributes.php](playground/attributes.php)
- [foreground.php](playground/foreground.php)
- [background.php](playground/background.php)

## 7. LICENSE

[MIT](LICENSE)

Copyright 2025 macocci7.
