<?php

namespace Macocci7\BashColorizer;

use Macocci7\BashColorizer\Filters\Filter;

class Converter
{
    /**
     * @return  int[]
     */
    public static function decimal(string $rgb): array
    {
        $patternS = '/^#([0-9a-f])([0-9a-f])([0-9a-f])$/';
        $patternL = '/^#([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/';
        if (preg_match($patternS, strtolower($rgb), $matches)) {
            // short format (#rgb)
            return [
                hexdec($matches[1] . $matches[1]),
                hexdec($matches[2] . $matches[2]),
                hexdec($matches[3] . $matches[3]),
            ];
        } elseif (preg_match($patternL, strtolower($rgb), $matches)) {
            // long format (#rrggbb)
            return [
                hexdec($matches[1]),
                hexdec($matches[2]),
                hexdec($matches[3]),
            ];
        }
        return [];
    }

    /**
     * @param   int[]   $rgb
     */
    public static function hex(array $rgb): string|null
    {
        if (empty($rgb)) {
            return null;
        }
        $rgb = Filter::rgb($rgb);
        return sprintf(
            "#%02s%02s%02s",
            dechex($rgb[0]),
            dechex($rgb[1]),
            dechex($rgb[2]),
        );
    }
}
