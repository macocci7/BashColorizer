<?php

declare(strict_types=1);

namespace Macocci7\BashColorizer\Tests\Enums;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Macocci7\BashColorizer\Colorizer;
use Macocci7\BashColorizer\Enums\Background;

final class BackgroundTest extends TestCase
{
    public static function provide_code_can_return_correct_code(): array
    {
        return [
            'background:Black' => ['enum' => Background::Black, 'expected' => 40],
            'background:Red' => ['enum' => Background::Red, 'expected' => 41],
            'background:Green' => ['enum' => Background::Green, 'expected' => 42],
            'background:Yellow' => ['enum' => Background::Yellow, 'expected' => 43],
            'background:Blue' => ['enum' => Background::Blue, 'expected' => 44],
            'background:Magenta' => ['enum' => Background::Magenta, 'expected' => 45],
            'background:Cyan' => ['enum' => Background::Cyan, 'expected' => 46],
            'background:White' => ['enum' => Background::White, 'expected' => 47],
            'background:Extended' => ['enum' => Background::Extended, 'expected' => 48],
            'background:Default' => ['enum' => Background::Default, 'expected' => 49],
        ];
    }

    #[DataProvider('provide_code_can_return_correct_code')]
    public function test_code_can_return_correct_code(Background $enum, int $expected): void
    {
        $this->assertSame($expected, $enum->code());
    }

    public function test_codes_can_return_correct_codes(): void
    {
        $codes = [
            'black' => 40,
            'red' => 41,
            'green' => 42,
            'yellow' => 43,
            'blue' => 44,
            'magenta' => 45,
            'cyan' => 46,
            'white' => 47,
            'extended' => 48,
            'default' => 49,
        ];
        $this->assertSame($codes, Background::codes());
    }
}
