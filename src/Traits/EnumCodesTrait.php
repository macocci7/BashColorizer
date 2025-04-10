<?php

namespace Macocci7\BashColorizer\Traits;

trait EnumCodesTrait
{
    use EnumTrait;

    /**
     * @return  int[]
     */
    public static function codes(): array
    {
        $codes = [];
        foreach (static::cases() as $case) {
            $codes[$case->value] = $case->code();
        }
        return $codes;
    }
}
