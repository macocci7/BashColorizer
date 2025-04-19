<?php

declare(strict_types=1);

namespace Macocci7\BashColorizer\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Macocci7\BashColorizer\Converter;

final class ConverterTest extends TestCase
{
    public static function provide_decimal_can_return_correct_array(): array
    {
        return [
            '#000' => ['rgb' => '#000', 'expected' => [0, 0, 0]],
            '#123' => ['rgb' => '#123', 'expected' => [17, 34, 51]],
            '#fed' => ['rgb' => '#fed', 'expected' => [255, 238, 221]],
            '#FED' => ['rgb' => '#FED', 'expected' => [255, 238, 221]],
            '#19f' => ['rgb' => '#19f', 'expected' => [17, 153, 255]],
            '#19F' => ['rgb' => '#19F', 'expected' => [17, 153, 255]],
            '#000000' => ['rgb' => '#000000', 'expected' => [0, 0, 0]],
            '#123456' => ['rgb' => '#123456', 'expected' => [18, 52, 86]],
            '#ffeedd' => ['rgb' => '#ffeedd', 'expected' => [255, 238, 221]],
            '#FFEEDD' => ['rgb' => '#FFEEDD', 'expected' => [255, 238, 221]],
            '#123abc' => ['rgb' => '#123abc', 'expected' => [18, 58, 188]],
            '#123ABC' => ['rgb' => '#123abc', 'expected' => [18, 58, 188]],

            'fff' => ['rgb' => 'fff', 'expected' => []],
            'fffffff' => ['rgb' => 'fffffff', 'expected' => []],
            '#' => ['rgb' => '#', 'expected' => []],
            '#1' => ['rgb' => '#1', 'expected' => []],
            '#12' => ['rgb' => '#12', 'expected' => []],
            '#efg' => ['rgb' => '#efg', 'expected' => []],
            '#EFG' => ['rgb' => '#EFG', 'expected' => []],
            '#1234' => ['rgb' => '#1234', 'expected' => []],
            '#12345' => ['rgb' => '#12345', 'expected' => []],
            '#bcdefg' => ['rgb' => '#bcdefg', 'expected' => []],
            '#BCDEFG' => ['rgb' => '#BCDEFG', 'expected' => []],
            '#1234567' => ['rgb' => '#1234567', 'expected' => []],
            '#abcdefg' => ['rgb' => '#abcdefg', 'expected' => []],
        ];
    }

    #[DataProvider('provide_decimal_can_return_correct_array')]
    public function test_decimal_can_return_correct_array(string $rgb, array $expected): void
    {
        $this->assertSame($expected, Converter::decimal($rgb));
    }

    public static function provide_hex_can_return_correct_hex_code(): array
    {
        return [
            'empty' => ['rgb' => [], 'expected' => null],
            '[0]' => ['rgb' => [0], 'expected' => '#000000'],
            '[1]' => ['rgb' => [1], 'expected' => '#010000'],
            '[1, 2]' => ['rgb' => [1, 2], 'expected' => '#010200'],
            '[1, 2, 3]' => ['rgb' => [1, 2, 3], 'expected' => '#010203'],
            '[0, 0, 10]' => ['rgb' => [0, 0, 10], 'expected' => '#00000a'],
            '[0, 0, 171]' => ['rgb' => [0, 0, 171], 'expected' => '#0000ab'],
            '[0, 171, 205]' => ['rgb' => [0, 171, 205], 'expected' => '#00abcd'],
            '[171, 205, 239]' => ['rgb' => [171, 205, 239], 'expected' => '#abcdef'],
            '[-1, 0, 1]' => ['rgb' => [-1, 0, 1], 'expected' => '#000001'],
            '[254, 255, 256]' => ['rgb' => [254, 255, 256], 'expected' => '#feffff'],
        ];
    }

    #[DataProvider('provide_hex_can_return_correct_hex_code')]
    public function test_hex_can_return_correct_hex_code(array $rgb, string|null $expected): void
    {
        $this->assertSame($expected, Converter::hex($rgb));
    }
}
