<?php

declare(strict_types=1);

namespace Macocci7\BashColorizer\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Macocci7\BashColorizer\Traits\ValidationTrait;

final class ValidationTraitTest extends TestCase
{
    public static function provide_isShortHex_can_return_correct_bool(): array
    {
        return [
            'empty' => ['rgb' => '', 'expected' => false],
            '123' => ['rgb' => '123', 'expected' => false],
            '123456' => ['rgb' => '123456', 'expected' => false],
            '#' => ['rgb' => '#', 'expected' => false],
            '#1' => ['rgb' => '#1', 'expected' => false],
            '#12' => ['rgb' => '#12', 'expected' => false],
            '#123' => ['rgb' => '#123', 'expected' => true],
            '#1234' => ['rgb' => '#1234', 'expected' => false],
            '#12345' => ['rgb' => '#12345', 'expected' => false],
            '#123456' => ['rgb' => '#123456', 'expected' => false],
            '#1234567' => ['rgb' => '#1234567', 'expected' => false],
            '#efg' => ['rgb' => '#efg', 'expected' => false],
            '#def' => ['rgb' => '#def', 'expected' => true],
            '#000' => ['rgb' => '#000', 'expected' => true],
            '#1af' => ['rgb' => '#1af', 'expected' => true],
        ];
    }

    #[DataProvider('provide_isShortHex_can_return_correct_bool')]
    public function test_isShortHex_can_return_correct_bool(string $rgb, bool $expected): void
    {
        $validator = new class {
            use ValidationTrait;
        };
        $this->assertSame($expected, $validator::isShortHex($rgb));
    }

    public static function provide_isLongHex_can_return_correct_bool(): array
    {
        return [
            'empty' => ['rgb' => '', 'expected' => false],
            'fff' => ['rgb' => 'fff', 'expected' => false],
            'ffffff' => ['rgb' => 'ffffff', 'expected' => false],
            '#' => ['rgb' => '#', 'expected' => false],
            '#1' => ['rgb' => '#1', 'expected' => false],
            '#12' => ['rgb' => '#12', 'expected' => false],
            '#123' => ['rgb' => '#123', 'expected' => false],
            '#1234' => ['rgb' => '#1234', 'expected' => false],
            '#12345' => ['rgb' => '#12345', 'expected' => false],
            '#123456' => ['rgb' => '#123456', 'expected' => true],
            '#1234567' => ['rgb' => '#1234567', 'expected' => false],
            '#000000' => ['rgb' => '#000000', 'expected' => true],
            '#abcdef' => ['rgb' => '#abcdef', 'expected' => true],
            '#bcdefg' => ['rgb' => '#bcdefg', 'expected' => false],
            '#123def' => ['rgb' => '#123def', 'expected' => true],
        ];
    }

    #[DataProvider('provide_isLongHex_can_return_correct_bool')]
    public function test_isLongHex_can_return_correct_bool(string $rgb, bool $expected): void
    {
        $validator = new class {
            use ValidationTrait;
        };
        $this->assertSame($expected, $validator::isLongHex($rgb));
    }

    public static function provide_isHex_can_return_correct_bool(): array
    {
        return [
            'empty' => ['rgb' => '', 'expected' => false],
            '123' => ['rgb' => '123', 'expected' => false],
            '123456' => ['rgb' => '123456', 'expected' => false],
            '#' => ['rgb' => '#', 'expected' => false],
            '#1' => ['rgb' => '#1', 'expected' => false],
            '#12' => ['rgb' => '#12', 'expected' => false],
            '#123' => ['rgb' => '#123', 'expected' => true],
            '#1234' => ['rgb' => '#1234', 'expected' => false],
            '#12345' => ['rgb' => '#12345', 'expected' => false],
            '#123456' => ['rgb' => '#123456', 'expected' => true],
            '#1234567' => ['rgb' => '#1234567', 'expected' => false],
            '#000' => ['rgb' => '#000', 'expected' => true],
            '#def' => ['rgb' => '#def', 'expected' => true],
            '#efg' => ['rgb' => '#efg', 'expected' => false],
            '#09f' => ['rgb' => '#09f', 'expected' => true],
            '#000000' => ['rgb' => '#000000', 'expected' => true],
            '#abcdef' => ['rgb' => '#abcdef', 'expected' => true],
            '#bcdefg' => ['rgb' => '#bcdefg', 'expected' => false],
            '#123def' => ['rgb' => '#123def', 'expected' => true],
        ];
    }

    #[DataProvider('provide_isHex_can_return_correct_bool')]
    public function test_isHex_can_return_correct_bool(string $rgb, bool $expected): void
    {
        $validator = new class {
            use ValidationTrait;
        };
        $this->assertSame($expected, $validator::isHex($rgb));
    }
}
