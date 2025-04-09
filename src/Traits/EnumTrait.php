<?php

namespace Macocci7\BashColorizer\Traits;

trait EnumTrait
{
    /**
     * returns names.
     *
     * @return  string[]
     */
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * returns values.
     *
     * @return  mixed[]
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * returns names, values or set of names and values.
     *
     * @return  mixed[]
     */
    public static function asArray(): array
    {
        if (empty(self::values())) {
            return self::names();
        }

        if (empty(self::names())) {
            return self::values();
        }

        return array_column(self::cases(), 'value', 'name');
    }
}
