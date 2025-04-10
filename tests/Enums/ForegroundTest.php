<?php

declare(strict_types=1);

namespace Macocci7\BashColorizer\Tests\Enums;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Macocci7\BashColorizer\Colorizer;
use Macocci7\BashColorizer\Enums\Foreground;

final class ForegroundTest extends TestCase
{
    public static function provide_code_can_return_correct_code(): array
    {
        return [
            'foreground:Black' => ['enum' => Foreground::Black, 'expected' => 30],
            'foreground:Red' => ['enum' => Foreground::Red, 'expected' => 31],
            'foreground:Green' => ['enum' => Foreground::Green, 'expected' => 32],
            'foreground:Yellow' => ['enum' => Foreground::Yellow, 'expected' => 33],
            'foreground:Blue' => ['enum' => Foreground::Blue, 'expected' => 34],
            'foreground:Magenta' => ['enum' => Foreground::Magenta, 'expected' => 35],
            'foreground:Cyan' => ['enum' => Foreground::Cyan, 'expected' => 36],
            'foreground:White' => ['enum' => Foreground::White, 'expected' => 37],
            'foreground:Extended' => ['enum' => Foreground::Extended, 'expected' => 38],
            'foreground:Default' => ['enum' => Foreground::Default, 'expected' => 39],
        ];
    }

    #[DataProvider('provide_code_can_return_correct_code')]
    public function test_code_can_return_correct_code(Foreground $enum, int $expected): void
    {
        $this->assertSame($expected, $enum->code());
    }

    public function test_codes_can_return_correct_codes(): void
    {
        $codes = [
            'black' => 30,
            'red' => 31,
            'green' => 32,
            'yellow' => 33,
            'blue' => 34,
            'magenta' => 35,
            'cyan' => 36,
            'white' => 37,
            'extended' => 38,
            'default' => 39,
        ];
        $this->assertSame($codes, Foreground::codes());
    }
}
