<?php

namespace Macocci7\BashColorizer\Traits;

trait ValidationTrait
{
    public static function isShortHex(string $rgb): bool
    {
        $patternS = '/^#([0-9a-f])([0-9a-f])([0-9a-f])$/';
        return preg_match($patternS, $rgb) ? true : false;
    }

    public static function isLongHex(string $rgb): bool
    {
        $patternL = '/^#([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/';
        return preg_match($patternL, $rgb) ? true : false;
    }

    public static function isHex(string $rgb): bool
    {
        return static::isShortHex($rgb) || static::isLongHex($rgb);
    }
}
