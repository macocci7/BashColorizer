<?php

namespace Macocci7\BashColorizer\Enums;

use Macocci7\BashColorizer\Traits\EnumCodesTrait;

enum Attribute: string
{
    use EnumCodesTrait;

    case Reset = "reset";
    case Bold = "bold";
    case Faint = "faint";
    case Italic = "italic";
    case Underline = "underline";
    case Blink = "blink";
    case FastBlink = "fast-blink";
    case Reverse = "reverse";
    case Conceal = "conceal";
    case Strike = "strike";
    case Gothic = "gothic";
    case DoubleUnderline = "double-underline";
    case Normal = "normal";
    case NoItalic = "no-italic";
    case NoUnderline = "no-underline";
    case NoBlink = "no-blink";
    case NoReverse = "no-reverse";
    case NoConceal = "no-conceal";
    case NoStrike = "no-strike";

    public function code(): int
    {
        return match ($this) {
            static::Reset => 0,
            static::Bold => 1,
            static::Faint => 2,
            static::Italic => 3,
            static::Underline => 4,
            static::Blink => 5,
            static::FastBlink => 6,
            static::Reverse => 7,
            static::Conceal => 8,
            static::Strike => 9,
            static::Gothic => 20,
            static::DoubleUnderline => 21,
            static::Normal => 22,
            static::NoItalic => 23,
            static::NoUnderline => 24,
            static::NoBlink => 25,
            static::NoReverse => 27,
            static::NoConceal => 28,
            static::NoStrike => 29,
        };
    }
}
