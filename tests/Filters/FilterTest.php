<?php

declare(strict_types=1);

namespace Macocci7\BashColorizer\Tests\Fiilters;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Macocci7\BashColorizer\Filters\Filter;

final class FilterTest extends TestCase
{
    public static function provide_number_can_return_number_correctly(): array
    {
        return [
            'number:-255' => ['number' => -255, 'expected' => 0],
            'number:-1' => ['number' => -1, 'expected' => 0],
            'number:0' => ['number' => 0, 'expected' => 0],
            'number:1' => ['number' => 1, 'expected' => 1],
            'number:100' => ['number' => 100, 'expected' => 100],
            'number:254' => ['number' => 254, 'expected' => 254],
            'number:255' => ['number' => 255, 'expected' => 255],
            'number:256' => ['number' => 256, 'expected' => 255],
            'number:1024' => ['number' => 1024, 'expected' => 255],
        ];
    }

    #[DataProvider('provide_number_can_return_number_correctly')]
    public function test_number_can_return_number_correctly(int $number, int $expected): void
    {
        $this->assertEquals($expected, Filter::number($number));
    }

    public static function provide_rgb_can_return_rgb_array_correctly(): array
    {
        return [
            // 0 element
            '[]' => ['rgb' => [], 'expected' => [0, 0, 0]],
            // 1 element
            '["-1"]' => ['rgb' => ["-1"], 'expected' => [0, 0, 0]],
            '["a"]' => ['rgb' => ["a"], 'expected' => [0, 0, 0]],
            '[true]' => ['rgb' => [true], 'expected' => [0, 0, 0]],
            '[false]' => ['rgb' => [false], 'expected' => [0, 0, 0]],
            '[1.5]' => ['rgb' => [1.5], 'expected' => [0, 0, 0]],
            '[[]]' => ['rgb' => [[]], 'expected' => [0, 0, 0]],
            '[[1]]' => ['rgb' => [[1]], 'expected' => [0, 0, 0]],
            '[[-1]]' => ['rgb' => [[-1]], 'expected' => [0, 0, 0]],
            '[[-1, 1]]' => ['rgb' => [[-1, 1]], 'expected' => [0, 0, 0]],
            '[stdClass]' => ['rgb' => [new \stdClass()], 'expected' => [0, 0, 0]],
            '[Closure]' => ['rgb' => [fn () => true], 'expected' => [0, 0, 0]],
            '[-1]' => ['rgb' => [-1], 'expected' => [0, 0, 0]],
            '[128]' => ['rgb' => [128], 'expected' => [128, 0, 0]],
            // 2 elements
            '[128, "-1"]' => ['rgb' => [128, "-1"], 'expected' => [128, 0, 0]],
            '[128, "a"]' => ['rgb' => [128, "a"], 'expected' => [128, 0, 0]],
            '[128, true]' => ['rgb' => [128, true], 'expected' => [128, 0, 0]],
            '[128, false]' => ['rgb' => [128, false], 'expected' => [128, 0, 0]],
            '[128, 1.5]' => ['rgb' => [128, 1.5], 'expected' => [128, 0, 0]],
            '[128, []]' => ['rgb' => [128, []], 'expected' => [128, 0, 0]],
            '[128, [1]]' => ['rgb' => [128, [1]], 'expected' => [128, 0, 0]],
            '[128, [-1]]' => ['rgb' => [128, [-1]], 'expected' => [128, 0, 0]],
            '[128, [-1, 1]]' => ['rgb' => [128, [-1, 1]], 'expected' => [128, 0, 0]],
            '[128, stdClass]' => ['rgb' => [128, new \stdClass()], 'expected' => [128, 0, 0]],
            '[-1, -1]' => ['rgb' => [-1, -1], 'expected' => [0, 0, 0]],
            '[-1, 128]' => ['rgb' => [-1, 128], 'expected' => [0, 128, 0]],
            '[128, -1]' => ['rgb' => [128, -1], 'expected' => [128, 0, 0]],
            '[128, 128]' => ['rgb' => [128, 128], 'expected' => [128, 128, 0]],
            // 3 elements
            '[128, 128, "-1"]' => ['rgb' => [128, 128, "-1"], 'expected' => [128, 128, 0]],
            '[128, 128, "a"]' => ['rgb' => [128, 128, "a"], 'expected' => [128, 128, 0]],
            '[128, 128, true]' => ['rgb' => [128, 128, true], 'expected' => [128, 128, 0]],
            '[128, 128, false]' => ['rgb' => [128, 128, false], 'expected' => [128, 128, 0]],
            '[128, 128, 1.5]' => ['rgb' => [128, 128, 1.5], 'expected' => [128, 128, 0]],
            '[128, 128, []]' => ['rgb' => [128, 128, []], 'expected' => [128, 128, 0]],
            '[128, 128, [1]]' => ['rgb' => [128, 128, [1]], 'expected' => [128, 128, 0]],
            '[128, 128, [-1]]' => ['rgb' => [128, 128, [-1]], 'expected' => [128, 128, 0]],
            '[128, 128, [-1, 1]]' => ['rgb' => [128, 128, [-1, 1]], 'expected' => [128, 128, 0]],
            '[128, 128, stdClass]' => ['rgb' => [128, 128, new \stdClass()], 'expected' => [128, 128, 0]],
            '[-1, -1, -1]' => ['rgb' => [-1, -1, -1], 'expected' => [0, 0, 0]],
            '[-1, -1, 128]' => ['rgb' => [-1, -1, 128], 'expected' => [0, 0, 128]],
            '[-1, 128, -1]' => ['rgb' => [-1, 128, -1], 'expected' => [0, 128, 0]],
            '[-1, 128, 128]' => ['rgb' => [-1, 128, 128], 'expected' => [0, 128, 128]],
            '[128, -1, -1]' => ['rgb' => [128, -1, -1], 'expected' => [128, 0, 0]],
            '[128, -1, 128]' => ['rgb' => [128, -1, 128], 'expected' => [128, 0, 128]],
            '[128, 128, -1]' => ['rgb' => [128, 128, -1], 'expected' => [128, 128, 0]],
            '[128, 128, 128]' => ['rgb' => [128, 128, 128], 'expected' => [128, 128, 128]],
            // 4 elements
            '[128, 128, 128, 128]' => ['rgb' => [128, 128, 128, 128], 'expected' => [128, 128, 128]],
        ];
    }

    #[DataProvider('provide_rgb_can_return_rgb_array_correctly')]
    public function test_rgb_can_regturn_rgb_array_correctly(array $rgb, array $expected): void
    {
        $this->assertSame($expected, Filter::rgb($rgb));
    }
}
