<?php

namespace Macocci7\BashColorizer\Enums;

use Macocci7\BashColorizer\Traits\EnumCodesTrait;

enum Foreground: string
{
    use EnumCodesTrait;

    // Foreground Colors
    case Black = 'black';
    case Red = 'red';
    case Green = 'green';
    case Yellow = 'yellow';
    case Blue = 'blue';
    case Magenta = 'magenta';
    case Cyan = 'cyan';
    case White = 'white';
    case Extended = 'extended';
    case Default = 'default';

    public function code(): int
    {
        return match ($this) {
            static::Black => 30,
            static::Red => 31,
            static::Green => 32,
            static::Yellow => 33,
            static::Blue => 34,
            static::Magenta => 35,
            static::Cyan => 36,
            static::White => 37,
            static::Extended => 38,
            static::Default => 39,
            default => null,
        };
    }
}
