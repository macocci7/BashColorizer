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
    public static function provide_config_can_set_config_correctly(): array
    {
        return [
            'case 1' => [
                'config' => [],
            ],
            'case 2' => [
                'config' => [0],
            ],
            'case 3' => [
                'config' => ['attributes' => null],
            ],
            'case 4' => [
                'config' => ['attributes' => ["bold", "italic"]],
            ],
            'case 5' => [
                'config' => [
                    'attributes' => ["bold", "italic"],
                    'forground' => "yellow",
                ],
            ],
            'case 6' => [
                'config' => [
                    'attributes' => ["bold", "italic"],
                    'forground' => "yellow",
                    'background' => "blue",
                ],
            ],
            'case 7' => [
                'config' => [
                    'attributes' => ["bold", "italic"],
                    'forground' => "yellow",
                    'background' => "blue",
                    'unnecessary' => "hello",
                ],
            ],
        ];
    }

    #[DataProvider('provide_config_can_set_config_correctly')]
    public function test_config_can_set_config_correctly(array $config): void
    {
        $this->assertSame($config, Colorizer::config($config)->config());
    }

    public static function provide_attributes_can_set_attributes_correctly(): array
    {
        return [
            '[]' => ['attributes' => []],
            '[null]' => ['attributes' => [null]],
            '[0]' => ['attributes' => [0]],
            '["bold"]' => ['attributes' => ["bold"]],
            '[Attribute::Bold]' => ['attributes' => [Attribute::Bold]],
            '["bold", "italic"]' => ['attributes' => ["bold", "italic"]],
        ];
    }

    #[DataProvider('provide_attributes_can_set_attributes_correctly')]
    public function test_attributes_can_set_attributes_correctly(array|null $attributes): void
    {
        Colorizer::attributes($attributes);
        $this->assertSame($attributes, Colorizer::attributes());
        $this->assertSame($attributes, Colorizer::config()['attributes']);
    }

    public static function provide_foreground_can_set_foreground_color_correctly(): array
    {
        return [
            '""' => ['foreground' => ""],
            '"blud"' => ['foreground' => "blud"],
            'Foreground::Red' => ['foreground' => Foreground::Red],
            '128' => ['foreground' => 128],
            '[0, 128, 255]' => ['foreground' => [0, 128, 255]],
        ];
    }

    #[DataProvider('provide_foreground_can_set_foreground_color_correctly')]
    public function test_foreground_can_set_foreground_color_correctly(string|Foreground|int|array $foreground): void
    {
        Colorizer::foreground($foreground);
        $this->assertSame($foreground, Colorizer::foreground());
        $this->assertSame($foreground, Colorizer::config()['foreground']);
    }

    public static function provide_background_can_set_background_color_correctly(): array
    {
        return [
            '""' => ['background' => ""],
            '"yellow"' => ['background' => "yellow"],
            'Background::Cyan' => ['background' => Background::Cyan],
            '128' => ['background' => 128],
            '[0, 128, 255]' => ['background' => [0, 128, 255]],
        ];
    }

    #[DataProvider('provide_background_can_set_background_color_correctly')]
    public function test_background_can_set_background_color_correctly(string|Background|int|array $background): void
    {
        Colorizer::background($background);
        $this->assertSame($background, Colorizer::background());
        $this->assertSame($background, Colorizer::config()['background']);
    }

    public static function provide_codes_can_return_codes_correctly(): array
    {
        return [
            'empty config' => [
                'config' => [
                ],
                'expected' => '',
            ],

            // cases for attributes
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
            'invalid string as arguments' => [
                'config' => [
                    'attributes' => ['invalid'],
                ],
                'expected' => '',
            ],
            'invalid enum as arguments' => [
                'config' => [
                    'attributes' => [Foreground::Green],
                ],
                'expected' => '',
            ],
            'true as arguments' => [
                'config' => [
                    'attributes' => [true],
                ],
                'expected' => '',
            ],
            'false as arguments' => [
                'config' => [
                    'attributes' => [false],
                ],
                'expected' => '',
            ],
            'int as arguments' => [
                'config' => [
                    'attributes' => [1],
                ],
                'expected' => '',
            ],
            'float as arguments' => [
                'config' => [
                    'attributes' => [1.5],
                ],
                'expected' => '',
            ],
            'array as arguments' => [
                'config' => [
                    'attributes' => [["bold"]],
                ],
                'expected' => '',
            ],
            'object as arguments' => [
                'config' => [
                    'attributes' => [new \stdClass()],
                ],
                'expected' => '',
            ],
            'closuer as arguments' => [
                'config' => [
                    'attributes' => [fn () => "bold"],
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

            // cases for foreground
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
            'true as foreground' => [
                'config' => [
                    'foreground' => true,
                ],
                'expected' => '',
            ],
            'false as foreground' => [
                'config' => [
                    'foreground' => false,
                ],
                'expected' => '',
            ],
            'float as foreground' => [
                'config' => [
                    'foreground' => 1.5,
                ],
                'expected' => '',
            ],
            'object as foreground' => [
                'config' => [
                    'foreground' => new \stdClass(),
                ],
                'expected' => '',
            ],
            'closure as foreground' => [
                'config' => [
                    'foreground' => fn () => "blue",
                ],
                'expected' => '',
            ],
            'Attribute enum as foreground' => [
                'config' => [
                    'foreground' => Attribute::Bold,
                ],
                'expected' => '',
            ],
            'Background enum as foreground' => [
                'config' => [
                    'foreground' => Background::Red,
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
            'int -1 as foreground' => [
                'config' => [
                    'foreground' => -1,
                ],
                'expected' => '38;5;0',
            ],
            'int 0 as foreground' => [
                'config' => [
                    'foreground' => 0,
                ],
                'expected' => '38;5;0',
            ],
            'int 1 as foreground' => [
                'config' => [
                    'foreground' => 1,
                ],
                'expected' => '38;5;1',
            ],
            'int 254 as foreground' => [
                'config' => [
                    'foreground' => 254,
                ],
                'expected' => '38;5;254',
            ],
            'int 255 as foreground' => [
                'config' => [
                    'foreground' => 255,
                ],
                'expected' => '38;5;255',
            ],
            'int 256 as foreground' => [
                'config' => [
                    'foreground' => 256,
                ],
                'expected' => '38;5;255',
            ],
            '[null] as foreground' => [
                'config' => [
                    'foreground' => [null],
                ],
                'expected' => '38;2;0;0;0',
            ],
            '[64] as foreground' => [
                'config' => [
                    'foreground' => [64],
                ],
                'expected' => '38;2;64;0;0',
            ],
            '[64, 128] as foreground' => [
                'config' => [
                    'foreground' => [64, 128],
                ],
                'expected' => '38;2;64;128;0',
            ],
            '[64, 128, 192] as foreground' => [
                'config' => [
                    'foreground' => [64, 128, 192],
                ],
                'expected' => '38;2;64;128;192',
            ],
            '[64, 128, 192, 255] as foreground' => [
                'config' => [
                    'foreground' => [64, 128, 192, 255],
                ],
                'expected' => '38;2;64;128;192',
            ],

            // cases for background
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
            'true as background' => [
                'config' => [
                    'background' => true,
                ],
                'expected' => '',
            ],
            'false as background' => [
                'config' => [
                    'background' => false,
                ],
                'expected' => '',
            ],
            'float as background' => [
                'config' => [
                    'background' => 1.5,
                ],
                'expected' => '',
            ],
            'object as background' => [
                'config' => [
                    'background' => new \stdClass(),
                ],
                'expected' => '',
            ],
            'closure as background' => [
                'config' => [
                    'background' => fn () => "magenta",
                ],
                'expected' => '',
            ],
            'Attribute enum as background' => [
                'config' => [
                    'background' => Attribute::Italic,
                ],
                'expected' => '',
            ],
            'Foregound enum as background' => [
                'config' => [
                    'background' => Foreground::Cyan,
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
            'int -1 as background' => [
                'config' => [
                    'background' => -1,
                ],
                'expected' => '48;5;0',
            ],
            'int 0 as background' => [
                'config' => [
                    'background' => 0,
                ],
                'expected' => '48;5;0',
            ],
            'int 1 as background' => [
                'config' => [
                    'background' => 1,
                ],
                'expected' => '48;5;1',
            ],
            'int 254 as background' => [
                'config' => [
                    'background' => 254,
                ],
                'expected' => '48;5;254',
            ],
            'int 255 as background' => [
                'config' => [
                    'background' => 255,
                ],
                'expected' => '48;5;255',
            ],
            'int 256 as background' => [
                'config' => [
                    'background' => 256,
                ],
                'expected' => '48;5;255',
            ],
            '[null] as background' => [
                'config' => [
                    'background' => [null],
                ],
                'expected' => '48;2;0;0;0',
            ],
            '[64] as background' => [
                'config' => [
                    'background' => [64],
                ],
                'expected' => '48;2;64;0;0',
            ],
            '[64, 128] as background' => [
                'config' => [
                    'background' => [64, 128],
                ],
                'expected' => '48;2;64;128;0',
            ],
            '[64, 128, 192] as background' => [
                'config' => [
                    'background' => [64, 128, 192],
                ],
                'expected' => '48;2;64;128;192',
            ],
            '[64, 128, 192, 255] as background' => [
                'config' => [
                    'background' => [64, 128, 192, 255],
                ],
                'expected' => '48;2;64;128;192',
            ],

            // combinations
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

    public static function provide_encode_can_return_encoded_value_correctly(): array
    {
        return [
            'empty config' => [
                'config' => [],
                'message' => 'Hi, there!',
                'expected' => 'Hi, there!',
            ],
            'bold' => [
                'config' => [
                    'attributes' => ["bold"],
                ],
                'message' => 'Hi, there!',
                'expected' => "\e[1mHi, there!\e[m",
            ],
            'italic, underline' => [
                'config' => [
                    'attributes' => ["italic", "underline"],
                ],
                'message' => 'Hi, there!',
                'expected' => "\e[3;4mHi, there!\e[m",
            ],
            'foreground:red' => [
                'config' => [
                    'foreground' => "red",
                ],
                'message' => 'Hi, there!',
                'expected' => "\e[31mHi, there!\e[m",
            ],
            'foreground:128' => [
                'config' => [
                    'foreground' => 128,
                ],
                'message' => 'Hi, there!',
                'expected' => "\e[38;5;128mHi, there!\e[m",
            ],
            'foreground:[0, 128, 255]' => [
                'config' => [
                    'foreground' => [0, 128, 255],
                ],
                'message' => 'Hi, there!',
                'expected' => "\e[38;2;0;128;255mHi, there!\e[m",
            ],
            'background:red' => [
                'config' => [
                    'background' => "red",
                ],
                'message' => 'Hi, there!',
                'expected' => "\e[41mHi, there!\e[m",
            ],
            'background:128' => [
                'config' => [
                    'background' => 128,
                ],
                'message' => 'Hi, there!',
                'expected' => "\e[48;5;128mHi, there!\e[m",
            ],
            'background:[0, 128, 255]' => [
                'config' => [
                    'background' => [0, 128, 255],
                ],
                'message' => 'Hi, there!',
                'expected' => "\e[48;2;0;128;255mHi, there!\e[m",
            ],
            'foreground:red' => [
                'config' => [
                    'foreground' => "red",
                ],
                'message' => 'Hi, there!',
                'expected' => "\e[31mHi, there!\e[m",
            ],
            'foreground:128' => [
                'config' => [
                    'foreground' => 128,
                ],
                'message' => 'Hi, there!',
                'expected' => "\e[38;5;128mHi, there!\e[m",
            ],
            'bold, italic, foreground:[0, 128, 255], background:[128, 255, 0]' => [
                'config' => [
                    'attributes' => ["bold", "italic"],
                    'foreground' => [0, 128, 255],
                    'background' => [128, 255, 0],
                ],
                'message' => 'Hi, there!',
                'expected' => "\e[1;3;38;2;0;128;255;48;2;128;255;0mHi, there!\e[m",
            ],
        ];
    }

    #[DataProvider('provide_encode_can_return_encoded_value_correctly')]
    public function test_encode_can_return_encoded_value_correctly(array $config, string $message, string $expected): void
    {
        $this->assertSame($expected, Colorizer::config($config)->encode($message));
    }

    public static function provide_readable_can_return_readable_value_correctly(): array
    {
        return [
            'empty config' => [
                'config' => [],
                'message' => 'Hi, there!',
                'expected' => 'Hi, there!',
            ],
            'bold' => [
                'config' => [
                    'attributes' => ["bold"],
                ],
                'message' => 'Hi, there!',
                'expected' => "\\033[1mHi, there!\\033[m",
            ],
            'italic, underline' => [
                'config' => [
                    'attributes' => ["italic", "underline"],
                ],
                'message' => 'Hi, there!',
                'expected' => "\\033[3;4mHi, there!\\033[m",
            ],
            'foreground:red' => [
                'config' => [
                    'foreground' => "red",
                ],
                'message' => 'Hi, there!',
                'expected' => "\\033[31mHi, there!\\033[m",
            ],
            'foreground:128' => [
                'config' => [
                    'foreground' => 128,
                ],
                'message' => 'Hi, there!',
                'expected' => "\\033[38;5;128mHi, there!\\033[m",
            ],
            'foreground:[0, 128, 255]' => [
                'config' => [
                    'foreground' => [0, 128, 255],
                ],
                'message' => 'Hi, there!',
                'expected' => "\\033[38;2;0;128;255mHi, there!\\033[m",
            ],
            'background:red' => [
                'config' => [
                    'background' => "red",
                ],
                'message' => 'Hi, there!',
                'expected' => "\\033[41mHi, there!\\033[m",
            ],
            'background:128' => [
                'config' => [
                    'background' => 128,
                ],
                'message' => 'Hi, there!',
                'expected' => "\\033[48;5;128mHi, there!\\033[m",
            ],
            'background:[0, 128, 255]' => [
                'config' => [
                    'background' => [0, 128, 255],
                ],
                'message' => 'Hi, there!',
                'expected' => "\\033[48;2;0;128;255mHi, there!\\033[m",
            ],
            'foreground:red' => [
                'config' => [
                    'foreground' => "red",
                ],
                'message' => 'Hi, there!',
                'expected' => "\\033[31mHi, there!\\033[m",
            ],
            'foreground:128' => [
                'config' => [
                    'foreground' => 128,
                ],
                'message' => 'Hi, there!',
                'expected' => "\\033[38;5;128mHi, there!\\033[m",
            ],
            'bold, italic, foreground:[0, 128, 255], background:[128, 255, 0]' => [
                'config' => [
                    'attributes' => ["bold", "italic"],
                    'foreground' => [0, 128, 255],
                    'background' => [128, 255, 0],
                ],
                'message' => 'Hi, there!',
                'expected' => "\\033[1;3;38;2;0;128;255;48;2;128;255;0mHi, there!\\033[m",
            ],
        ];
    }

    #[DataProvider('provide_readable_can_return_readable_value_correctly')]
    public function test_readable_can_return_readable_value_correctly(array $config, string $message, string $expected): void
    {
        $this->assertSame($expected, Colorizer::config($config)->readable($message));
    }
}
