<?php

declare(strict_types=1);

namespace Macocci7\BashColorizer\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Macocci7\BashColorizer\Colorizer;
use Macocci7\BashColorizer\Enums\Attribute;
use Macocci7\BashColorizer\Enums\Foreground;
use Macocci7\BashColorizer\Enums\Background;

final class ColorizerTest extends TestCase
{
    public static function provide_codes_can_return_codes_correctly(): array
    {
        return [
            'empty config' => [
                'config' => [
                ],
                'expected' => '',
            ],
            'empty attributes' => [
                'config' => [
                    'attributes' => [],
                ],
                'expected' => '',
            ],
            'null attributes' => [
                'config' => [
                    'attributes' => [null],
                ],
                'expected' => '',
            ],
            'invalid as arguments' => [
                'config' => [
                    'attributes' => ['invalid'],
                ],
                'expected' => '',
            ],
            'reset' => [
                'config' => [
                    'attributes' => ['reset'],
                ],
                'expected' => '0',
            ],
            'bold' => [
                'config' => [
                    'attributes' => ['bold'],
                ],
                'expected' => '1',
            ],
            'bold italic' => [
                'config' => [
                    'attributes' => ['bold', 'italic'],
                ],
                'expected' => '1;3',
            ],
            'Bold' => [
                'config' => [
                    'attributes' => [Attribute::Bold],
                ],
                'expected' => '1',
            ],
            'Bold italic' => [
                'config' => [
                    'attributes' => [Attribute::Bold, 'italic'],
                ],
                'expected' => '1;3',
            ],
            'Bold Italic' => [
                'config' => [
                    'attributes' => [Attribute::Bold, Attribute::Italic],
                ],
                'expected' => '1;3',
            ],
            'bold Italic' => [
                'config' => [
                    'attributes' => ['bold', Attribute::Italic],
                ],
                'expected' => '1;3',
            ],
            'empty foreground' => [
                'config' => [
                    'foreground' => '',
                ],
                'expected' => '',
            ],
            'null foreground' => [
                'config' => [
                    'foreground' => null,
                ],
                'expected' => '',
            ],
            'invalid as foreground' => [
                'config' => [
                    'foreground' => 'invalid',
                ],
                'expected' => '',
            ],
            'yellow as foreground' => [
                'config' => [
                    'foreground' => 'yellow',
                ],
                'expected' => '33',
            ],
            'Yellow as foreground' => [
                'config' => [
                    'foreground' => Foreground::Yellow,
                ],
                'expected' => '33',
            ],
            'empty as background' => [
                'config' => [
                    'background' => '',
                ],
                'expected' => '',
            ],
            'null as background' => [
                'config' => [
                    'background' => null,
                ],
                'expected' => '',
            ],
            'invalid as background' => [
                'config' => [
                    'background' => 'invalid',
                ],
                'expected' => '',
            ],
            'green as background' => [
                'config' => [
                    'background' => 'green',
                ],
                'expected' => '42',
            ],
            'Green as background' => [
                'config' => [
                    'background' => Background::Green,
                ],
                'expected' => '42',
            ],
            'empty attributes, foreground and background' => [
                'config' => [
                    'attributes' => [],
                    'foreground' => '',
                    'background' => '',
                ],
                'expected' => '',
            ],
            'empty as attributes, empty foreground and background' => [
                'config' => [
                    'attributes' => [''],
                    'foreground' => '',
                    'background' => '',
                ],
                'expected' => '',
            ],
            'null as attributes, empty foreground and background' => [
                'config' => [
                    'attributes' => [null],
                    'foreground' => '',
                    'background' => '',
                ],
                'expected' => '',
            ],
            'null as attributes, foreground and background' => [
                'config' => [
                    'attributes' => [null],
                    'foreground' => null,
                    'background' => null,
                ],
                'expected' => '',
            ],
            'invalid as attributes, empty foreground and background' => [
                'config' => [
                    'attributes' => ['invalid'],
                    'foreground' => '',
                    'background' => '',
                ],
                'expected' => '',
            ],
            'invalid as attributes, foreground and background' => [
                'config' => [
                    'attributes' => ['invalid'],
                    'foreground' => 'invalid',
                    'background' => 'invalid',
                ],
                'expected' => '',
            ],
            'bold, empty foreground and background' => [
                'config' => [
                    'attributes' => ['bold'],
                    'foreground' => '',
                    'background' => '',
                ],
                'expected' => '1',
            ],
            'bold, red foreground and empty background' => [
                'config' => [
                    'attributes' => ['bold'],
                    'foreground' => 'red',
                    'background' => '',
                ],
                'expected' => '1;31',
            ],
            'bold, red foreground and yellow background' => [
                'config' => [
                    'attributes' => ['bold'],
                    'foreground' => 'red',
                    'background' => 'yellow',
                ],
                'expected' => '1;31;43',
            ],
            'bold, empty foreground and yellow background' => [
                'config' => [
                    'attributes' => ['bold'],
                    'foreground' => '',
                    'background' => 'yellow',
                ],
                'expected' => '1;43',
            ],
            'bold, italic, red foreground and yellow background' => [
                'config' => [
                    'attributes' => ['bold', 'italic'],
                    'foreground' => 'red',
                    'background' => 'yellow',
                ],
                'expected' => '1;3;31;43',
            ],
        ];
    }

    #[DataProvider('provide_codes_can_return_codes_correctly')]
    public function test_codes_can_return_codes_correctly(array $config, string $expected): void
    {
        $this->assertSame($expected, Colorizer::codes($config));
    }
}
