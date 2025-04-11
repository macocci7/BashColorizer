<?php

namespace Macocci7\BashColorizer;

use Macocci7\BashColorizer\Enums\Attribute;
use Macocci7\BashColorizer\Enums\Foreground;
use Macocci7\BashColorizer\Enums\Background;
use Macocci7\BashColorizer\Filters\Filter;

class Colorizer
{
    protected const ESC = "\e";

    /**
     * @var array<string, mixed>    $config
     */
    protected static array $config = [];

    /**
     * @param   array<string, mixed>    $config
     */
    public function __construct(array $config = [])
    {
        static::$config = $config;
    }

    /**
     * @param   string[]|Attribute[]|null   $attributes = []
     * @return  string[]|null|self
     */
    public static function attributes(array|null $attributes = null): array|null|self
    {
        if (is_null($attributes)) {
            return self::$config['attributes'] ?? null;
        }
        $config = static::$config;
        $config['attributes'] = $attributes;
        static::$config = $config;
        return new self($config);
    }

    /**
     * @param   string|Foreground|int|int[]|null $foreground = null
     * @return  string|Foreground|int|int[]|null|self
     */
    public static function foreground(
        string|Foreground|int|array|null $foreground = null
    ): string|Foreground|int|array|null|self {
        if (is_null($foreground)) {
            return self::$config['foreground'] ?? null;
        }
        static::$config['foreground'] = $foreground;
        return new self(static::$config);
    }

    /**
     * @param   string|Background|int|int[]|null $background = null
     * @return  string|Background|int|int[]|null|self
     */
    public static function background(
        string|Background|int|array|null $background = null
    ): string|Background|int|array|null|self {
        if (is_null($background)) {
            return self::$config['background'] ?? null;
        }
        static::$config['background'] = $background;
        return new self(static::$config);
    }

    /**
     * @param   array<string, mixed>    $config
     * @return  array<string, mixed>|self
     */
    public static function config(array|null $config = null): array|self
    {
        if (is_null($config)) {
            return static::$config;
        }
        static::$config = $config;
        return new self($config);
    }

    /**
     * @param   array<string, mixed>    $config = []
     * @return  int[]
     */
    protected static function getAttributeCodes(array $config = []): array
    {
        if (!isset($config['attributes'])) {
            return [];
        }

        $codes = [];

        foreach ($config['attributes'] as $attribute) {
            if (is_string($attribute)) {
                $codes[] = Attribute::tryFrom($attribute)?->code();
            } elseif ($attribute instanceof Attribute) {
                $codes[] = $attribute->code();
            }
        }

        return $codes;
    }

    /**
     * @param   array<string, mixed>    $config = []
     * @return  int[]
     */
    protected static function getForegroundCode(array $config = []): array
    {
        if (!isset($config['foreground'])) {
            return [];
        }

        $foreground = $config['foreground'];

        if (is_int($foreground) || is_array($foreground)) {
            return static::extendedCodes(Foreground::Extended, $foreground);
        }

        $code = null;
        if (is_string($foreground)) {
            $code = Foreground::tryFrom($foreground)?->code();
        } elseif ($foreground instanceof Foreground) {
            $code = $foreground->code();
        }

        return strlen($code ?? '') ? [$code] : [];
    }

    /**
     * @param   array<string, mixed>    $config = []
     * @return  int[]
     */
    protected static function getBackgroundCode(array $config = []): array
    {
        if (!isset($config['background'])) {
            return [];
        }

        $background = $config['background'];

        if (is_int($background) || is_array($background)) {
            return static::extendedCodes(Background::Extended, $background);
        }

        $code = null;

        if (is_string($background)) {
            $code = Background::tryFrom($background)?->code();
        } elseif ($background instanceof Background) {
            $code = $background->code();
        }

        return strlen($code ?? '') ? [$code] : [];
    }

    /**
     * @param   Foreground|Background   $enum
     * @param   int|int[]               $color
     * @return  int[]
     */
    protected static function extendedCodes(
        Foreground|Background $enum,
        int|array $color
    ): array {
        // 256 colors
        if (is_int($color)) {
            return [
                $enum::Extended->code(),
                5,
                Filter::number($color),
            ];
        }

        // 24bit (16777216) colors
        return [
            $enum::Extended->code(),
            2,
            ...Filter::rgb($color),
        ];
    }

    /**
     * @param   array<string, mixed>    $config = []
     */
    public static function codes(array $config = []): string
    {
        return implode(';', array_merge(
            self::getAttributeCodes($config),
            self::getForegroundCode($config),
            self::getBackgroundCode($config),
        ));
    }

    public static function encode(string $string, string $eol = ''): string
    {
        $codes = static::codes(static::$config);
        return empty($codes) ? $string : sprintf(
            '%s[%sm%s%s[m%s',
            static::ESC,
            $codes,
            $string,
            static::ESC,
            $eol,
        );
    }

    public static function readable(string $string, string $eol = ''): string
    {
        return str_replace(
            self::ESC,
            "\\033",
            static::encode($string, $eol)
        );
    }

    public static function echo(string $string, string $eol = ''): self
    {
        echo static::encode($string, $eol);
        return new self(static::$config);
    }
}
