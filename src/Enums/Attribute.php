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
    //case PrimaryFont = "primary-font";
    //case AlternativeFont1 = "alternative-font1";
    //case AlternativeFont2 = "alternative-font2";
    //case AlternativeFont3 = "alternative-font3";
    //case AlternativeFont4 = "alternative-font4";
    //case AlternativeFont5 = "alternative-font5";
    //case AlternativeFont6 = "alternative-font6";
    //case AlternativeFont7 = "alternative-font7";
    //case AlternativeFont8 = "alternative-font8";
    //case AlternativeFont9 = "alternative-font9";
    case Gothic = "gothic";
    case DoubleUnderline = "double-underline";
    case Normal = "normal";
    case NoItalic = "no-italic";
    case NoUnderline = "no-underline";
    case NoBlink = "no-blink";
    case ProportionalSpacing = "proportional-spacing";
    case NoReverse = "no-reverse";
    case NoConceal = "no-conceal";
    case NoStrike = "no-strike";
    case NoProportionalSpacing = "no-proportional-spacing";
    case Framed = "framed";
    case Encircled = "encircled";
    case Overlined = "overlined";
    case NoFramedNoEncircled = "no-framed-no-encircled";
    case NoOverlined = "no-overlined";
    case UnderlineColor = "underline-color";

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
            //static::PrimaryFont => 10,
            //static::AlternativeFont1 => 11,
            //static::AlternativeFont2 => 12,
            //static::AlternativeFont3 => 13,
            //static::AlternativeFont4 => 14,
            //static::AlternativeFont5 => 15,
            //static::AlternativeFont6 => 16,
            //static::AlternativeFont7 => 17,
            //static::AlternativeFont8 => 18,
            //static::AlternativeFont9 => 19,
            static::Gothic => 20,
            static::DoubleUnderline => 21,
            static::Normal => 22,
            static::NoItalic => 23,
            static::NoUnderline => 24,
            static::NoBlink => 25,
            static::ProportionalSpacing => 26,
            static::NoReverse => 27,
            static::NoConceal => 28,
            static::NoStrike => 29,
            static::NoProportionalSpacing => 50,
            static::Framed => 51,
            static::Encircled => 52,
            static::Overlined => 53,
            static::NoFramedNoEncircled => 54,
            static::NoOverlined => 55,
            static::UnderlineColor => 58,
        };
    }
}
