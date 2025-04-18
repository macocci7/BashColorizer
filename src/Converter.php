<?php

namespace Macocci7\BashColorizer;

class Converter
{
    /**
     * @return  int[]
     */
    public static function decimal(string $rgb): array
    {
        $patternS = '/^#([0-9a-f])([0-9a-f])([0-9a-f])$/';
        $patternL = '/^#([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/';
        if (preg_match($patternS, $rgb, $matches)) {
            // short format (#rgb)
            return [
                hexdec($matches[1] . $matches[1]),
                hexdec($matches[2] . $matches[2]),
                hexdec($matches[3] . $matches[3]),
            ];
        } elseif (preg_match($patternL, $rgb, $matches)) {
            // long format (#rrggbb)
            return [
                hexdec($matches[1]),
                hexdec($matches[2]),
                hexdec($matches[3]),
            ];
        }
        return [];
    }
}
