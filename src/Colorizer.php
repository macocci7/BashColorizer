<?php

namespace Macocci7\BashColorizer;

use Macocci7\BashColorizer\Enums\Attribute;
use Macocci7\BashColorizer\Enums\Foreground;
use Macocci7\BashColorizer\Enums\Background;

class Colorizer
{
    protected const ESC = "\e";

    protected static array $config = [];

    public function __construct(array $config = [])
    {
        static::$config = $config;
    }

    public static function attributes(array|null $attributes = []): array|null|self
    {
        if (is_null($attributes)) {
            return self::$config['attributes'] ?? null;
        }
        $config = static::$config;
        $config['attributes'] = $attributes;
        static::$config = $config;
        return new self($config);
    }

    public static function foreground(string|Foreground|null $foreground = null): string|null|self
    {
        if (is_null($foreground)) {
            return self::$config['foreground'] ?? null;
        }
        static::$config['foreground'] = $foreground;
        return new self(static::$config);
    }

    public static function background(string|Background|null $background = null): string|null|self
    {
        if (is_null($background)) {
            return self::$config['background'] ?? null;
        }
        static::$config['background'] = $background;
        return new self(static::$config);
    }

    public static function config(array|null $config = null): array|self
    {
        if (is_null($config)) {
            return static::$config;
        }
        static::$config = $config;
        return new self($config);
    }

    protected static function getAttributes(array $config = []): array
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

    protected static function getForegroundCode(array $config = []): array
    {
        if (!isset($config['foreground'])) {
            return [];
        }

        $code = null;
        $attribute = $config['foreground'];

        if (is_string($attribute)) {
            $code = Foreground::tryFrom($attribute)?->code();
        } elseif ($attribute instanceof Foreground) {
            $code = $attribute->code();
        }

        return strlen($code ?? '') ? [$code] : [];
    }

    protected static function getBackgroundCode(array $config = []): array
    {
        if (!isset($config['background'])) {
            return [];
        }

        $code = null;
        $attribute = $config['background'];

        if (is_string($attribute)) {
            $code = Background::tryFrom($attribute)?->code();
        } elseif ($attribute instanceof Background) {
            $code = $attribute->code();
        }

        return strlen($code ?? '') ? [$code] : [];
    }

    public static function codes(array $config = []): string
    {
        return implode(';', array_merge(
            self::getAttributes($config),
            self::getForegroundCode($config),
            self::getBackgroundCode($config),
        ));
    }

    public static function encode(string $string, string $eol = ''): string
    {
        return sprintf(
            '%s[%sm%s%s[m%s',
            static::ESC,
            static::codes(static::$config),
            $string,
            static::ESC,
            $eol,
        );
    }

    public static function echo(string $string, string $eol = ''): self
    {
        echo static::encode($string, $eol);
        return new self(static::$config);
    }
}
