<?php

namespace Macocci7\BashColorizer;

use Macocci7\BashColorizer\Converter;
use Macocci7\BashColorizer\Enums\Attribute;
use Macocci7\BashColorizer\Enums\Foreground;
use Macocci7\BashColorizer\Enums\Background;
use Macocci7\BashColorizer\Filters\Filter;

class Colorizer
{
    use Traits\ValidationTrait;

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
     * sets or returns attributes
     *
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
     * sets or returns foreground color
     *
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
     * sets or returns background color
     *
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
     * sets or returns underline color
     *
     * @param   string|int|int[]|null $underline = null
     * @return  string|int|int[]|null|self
     */
    public static function underline(
        string|int|array|null $underline = null
    ): string|int|array|null|self {
        if (is_null($underline)) {
            return self::$config['underline'] ?? null;
        }
        static::$config['underline'] = $underline;
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

    public static function hasAttribute(string|Attribute $attribute): bool
    {
        $attributes = static::attributes();
        if (empty($attributes)) {
            return false;
        }
        if (is_string($attribute)) {
            return is_null(Attribute::tryFrom($attribute))
                ? false
                : in_array($attribute, $attributes)
                    || in_array(Attribute::from($attribute), $attributes);
        }
        return in_array($attribute->value, $attributes)
            || in_array($attribute, $attributes);
    }

    /**
     * @return  int[]
     */
    protected static function getAttributeCodes(): array
    {
        if (!isset(static::$config['attributes'])) {
            return [];
        }

        $codes = [];

        foreach (static::$config['attributes'] as $attribute) {
            if (is_string($attribute)) {
                $codes[] = Attribute::tryFrom($attribute)?->code();
            } elseif ($attribute instanceof Attribute) {
                $codes[] = $attribute->code();
            }
        }

        return array_unique($codes);
    }

    /**
     * @return  int[]
     */
    protected static function getForegroundCode(): array
    {
        if (!isset(static::$config['foreground'])) {
            return [];
        }

        $foreground = static::$config['foreground'];

        if (is_int($foreground) || is_array($foreground)) {
            return static::extendedCodes(Foreground::Extended, $foreground);
        }

        $code = null;
        if (is_string($foreground)) {
            if (static::isHex($foreground)) {
                return [
                    Foreground::Extended->code(),
                    2,
                    ...Converter::decimal($foreground),
                ];
            }
            $code = Foreground::tryFrom($foreground)?->code();
        } elseif ($foreground instanceof Foreground) {
            $code = $foreground->code();
        }

        return strlen($code ?? '') ? [$code] : [];
    }

    /**
     * @return  int[]
     */
    protected static function getBackgroundCode(): array
    {
        if (!isset(static::$config['background'])) {
            return [];
        }

        $background = static::$config['background'];

        if (is_int($background) || is_array($background)) {
            return static::extendedCodes(Background::Extended, $background);
        }

        $code = null;

        if (is_string($background)) {
            if (static::isHex($background)) {
                return [
                    Background::Extended->code(),
                    2,
                    ...Converter::decimal($background),
                ];
            }
            $code = Background::tryFrom($background)?->code();
        } elseif ($background instanceof Background) {
            $code = $background->code();
        }

        return strlen($code ?? '') ? [$code] : [];
    }

    /**
     * @return  int[]
     */
    protected static function getUnderlineCode(): array
    {
        if (!isset(static::$config['underline'])) {
            return [];
        }

        $underline = static::$config['underline'];

        $attributeUnderline = static::hasAttribute('underline')
            ? []
            : [Attribute::Underline->code()];
        if (is_int($underline)) {
            return [
                ...$attributeUnderline,
                Attribute::UnderlineColor->code(),
                5,
                Filter::number($underline),
            ];
        }

        if (is_array($underline)) {
            return [
                ...$attributeUnderline,
                Attribute::UnderlineColor->code(),
                2,
                ...Filter::rgb($underline),
            ];
        }

        if (is_string($underline)) {
            if (static::isHex($underline)) {
                return [
                    ...$attributeUnderline,
                    Attribute::UnderlineColor->code(),
                    2,
                    ...Converter::decimal($underline),
                ];
            }
        }

        return [];
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

    public static function codes(): string
    {
        return implode(';', array_merge(
            self::getAttributeCodes(),
            self::getForegroundCode(),
            self::getBackgroundCode(),
            self::getUnderlineCode(),
        ));
    }

    public static function encode(string $string, string $eol = ''): string
    {
        $codes = static::codes();
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
