<?php

declare(strict_types=1);

namespace Macocci7\BashColorizer\Tests\Enums;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Macocci7\BashColorizer\Colorizer;
use Macocci7\BashColorizer\Enums\Attribute;

final class AttributeTest extends TestCase
{
    public static function provide_code_can_return_correct_code(): array
    {
        return [
            'attribute:Reset' => ['enum' => Attribute::Reset, 'expected' => 0],
            'attribute:Bold' => ['enum' => Attribute::Bold, 'expected' => 1],
            'attribute:Faint' => ['enum' => Attribute::Faint, 'expected' => 2],
            'attribute:Italic' => ['enum' => Attribute::Italic, 'expected' => 3],
            'attribute:Underline' => ['enum' => Attribute::Underline, 'expected' => 4],
            'attribute:Blink' => ['enum' => Attribute::Blink, 'expected' => 5],
            'attribute:FastBlink' => ['enum' => Attribute::FastBlink, 'expected' => 6],
            'attribute:Reverse' => ['enum' => Attribute::Reverse, 'expected' => 7],
            'attribute:Conceal' => ['enum' => Attribute::Conceal, 'expected' => 8],
            'attribute:Strike' => ['enum' => Attribute::Strike, 'expected' => 9],
            'attribute:Gothic' => ['enum' => Attribute::Gothic, 'expected' => 20],
            'attribute:DoubleUnderline' => ['enum' => Attribute::DoubleUnderline, 'expected' => 21],
            'attribute:Normal' => ['enum' => Attribute::Normal, 'expected' => 22],
            'attribute:NoItalic' => ['enum' => Attribute::NoItalic, 'expected' => 23],
            'attribute:NoUnderline' => ['enum' => Attribute::NoUnderline, 'expected' => 24],
            'attribute:NoBlink' => ['enum' => Attribute::NoBlink, 'expected' => 25],
            'attribute:NoReverse' => ['enum' => Attribute::NoReverse, 'expected' => 27],
            'attribute:NoConceal' => ['enum' => Attribute::NoConceal, 'expected' => 28],
            'attribute:NoStrike' => ['enum' => Attribute::NoStrike, 'expected' => 29],
        ];
    }

    #[DataProvider('provide_code_can_return_correct_code')]
    public function test_code_can_return_correct_code(Attribute $enum, int $expected): void
    {
        $this->assertSame($expected, $enum->code());
    }

    public function test_codes_can_return_correct_codes(): void
    {
        $codes = [
            'reset' => 0,
            'bold' => 1,
            'faint' => 2,
            'italic' => 3,
            'underline' => 4,
            'blink' => 5,
            'fast-blink' => 6,
            'reverse' => 7,
            'conceal' => 8,
            'strike' => 9,
            'gothic' => 20,
            'double-underline' => 21,
            'normal' => 22,
            'no-italic' => 23,
            'no-underline' => 24,
            'no-blink' => 25,
            'no-reverse' => 27,
            'no-conceal' => 28,
            'no-strike' => 29,
        ];
        $this->assertSame($codes, Attribute::codes());
    }
}
