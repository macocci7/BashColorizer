<?php

namespace Macocci7\BashColorizer\Enums;

use Macocci7\BashColorizer\Traits\EnumCodesTrait;

enum Background: string
{
    use EnumCodesTrait;

    // Background Colors
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
            static::Black => 40,
            static::Red => 41,
            static::Green => 42,
            static::Yellow => 43,
            static::Blue => 44,
            static::Magenta => 45,
            static::Cyan => 46,
            static::White => 47,
            static::Extended => 48,
            static::Default => 49,
            default => null,
        };
    }
}
