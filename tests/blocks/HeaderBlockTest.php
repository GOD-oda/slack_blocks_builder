<?php

declare(strict_types=1);

namespace Tests\Blocks;

use Blocks\HeaderBlock;
use Objects\PlainTextObject;
use PHPUnit\Framework\TestCase;

class HeaderBlockTest extends TestCase
{
    public function testFormat()
    {
        $text = PlainTextObject::create('text');
        $block = new HeaderBlock($text, 'block 1');
        $expected = [
            'type' => 'header',
            'text' => [
                'type' => 'plain_text',
                'text' => 'text'
            ],
            'block_id' => 'block 1'
        ];

        $this->assertSame($expected, $block->format());
    }

    public function testMaximumTextLength()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Maximum length of text is 150 characters.');

        $invalidText = str_repeat('a', 151);
        $obj = PlainTextObject::create($invalidText);
        new HeaderBlock($obj);
    }
}
