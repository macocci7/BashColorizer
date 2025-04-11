<?php

namespace Macocci7\BashColorizer\Filters;

class Filter
{
    public static function number(int $number): int
    {
        return $number < 0 ? 0 : ($number > 255 ? 255 : $number);
    }

    /**
     * @param   mixed[] $rgb
     * @return  int[]
     */
    public static function rgb(array $rgb): array
    {
        return [
            isset($rgb[0]) ? (is_int($rgb[0]) ? static::number($rgb[0]) : 0) : 0,
            isset($rgb[1]) ? (is_int($rgb[1]) ? static::number($rgb[1]) : 0) : 0,
            isset($rgb[2]) ? (is_int($rgb[2]) ? static::number($rgb[2]) : 0) : 0,
        ];
    }
}
