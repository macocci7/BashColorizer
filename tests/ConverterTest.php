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
            '#000000' => ['rgb' => '#000000', 'expected' => [0, 0, 0]],
            '#123456' => ['rgb' => '#123456', 'expected' => [18, 52, 86]],
            '#ffeedd' => ['rgb' => '#ffeedd', 'expected' => [255, 238, 221]],

            'fff' => ['rgb' => 'fff', 'expected' => []],
            'fffffff' => ['rgb' => 'fffffff', 'expected' => []],
            '#' => ['rgb' => '#', 'expected' => []],
            '#1' => ['rgb' => '#1', 'expected' => []],
            '#12' => ['rgb' => '#12', 'expected' => []],
            '#efg' => ['rgb' => '#efg', 'expected' => []],
            '#1234' => ['rgb' => '#1234', 'expected' => []],
            '#12345' => ['rgb' => '#12345', 'expected' => []],
            '#bcdefg' => ['rgb' => '#bcdefg', 'expected' => []],
            '#1234567' => ['rgb' => '#1234567', 'expected' => []],
            '#abcdefg' => ['rgb' => '#abcdefg', 'expected' => []],
        ];
    }

    #[DataProvider('provide_decimal_can_return_correct_array')]
    public function test_decimal_can_return_correct_array(string $rgb, array $expected): void
    {
        $this->assertSame($expected, Converter::decimal($rgb));
    }
}
