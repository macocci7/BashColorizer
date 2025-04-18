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
            'attribute:ProportionalSpacing' => ['enum' => Attribute::ProportionalSpacing, 'expected' => 26],
            'attribute:NoReverse' => ['enum' => Attribute::NoReverse, 'expected' => 27],
            'attribute:NoConceal' => ['enum' => Attribute::NoConceal, 'expected' => 28],
            'attribute:NoProportionalSpacing' => ['enum' => Attribute::NoProportionalSpacing, 'expected' => 50],
            'attribute:Framed' => ['enum' => Attribute::Framed, 'expected' => 51],
            'attribute:Encircled' => ['enum' => Attribute::Encircled, 'expected' => 52],
            'attribute:Overlined' => ['enum' => Attribute::Overlined, 'expected' => 53],
            'attribute:NoFramedNoEncircled' => ['enum' => Attribute::NoFramedNoEncircled, 'expected' => 54],
            'attribute:NoOverlined' => ['enum' => Attribute::NoOverlined, 'expected' => 55],
            'attribute:UnderlineColor' => ['enum' => Attribute::UnderlineColor, 'expected' => 58],
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
            'proportional-spacing' => 26,
            'no-reverse' => 27,
            'no-conceal' => 28,
            'no-strike' => 29,
            'no-proportional-spacing' => 50,
            'framed' => 51,
            'encircled' => 52,
            'overlined' => 53,
            'no-framed-no-encircled' => 54,
            'no-overlined' => 55,
            'underline-color' => 58,
        ];
        $this->assertSame($codes, Attribute::codes());
    }
}
