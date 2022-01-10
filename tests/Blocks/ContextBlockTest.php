<?php

declare(strict_types=1);

namespace SlackBlocksBuilder\Tests\Blocks;

use SlackBlocksBuilder\Blocks\ContextBlock;
use PHPUnit\Framework\TestCase;

class ContextBlockTest extends TestCase
{
    public function testFormat()
    {
        $block = new ContextBlock(blockId: 'block 1');
        $block
            ->addPlainTextObject(text: 'text', emoji: true)
            ->addImage(imageUrl: 'foo.png', altText: 'alt text');
        $expected = [
            'type' => 'context',
            'elements' => [
                [
                    'type' => 'plain_text',
                    'text' => 'text',
                    'emoji' => true
                ],
                [
                    'type' => 'image',
                    'image_url' => 'foo.png',
                    'alt_text' => 'alt text'
                ]
            ],
            'block_id' => 'block 1'
        ];

        $this->assertSame($expected, $block->format());
    }

    public function testInvalidElementsLength()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Maximum length of elements is 10.');

        $block = new ContextBlock();
        $elementNumber = 11;
        for ($i = 0; $i < $elementNumber; $i++) {
            $block->addPlainTextObject(text: 'text', emoji: true);
        }

        $block->format();
    }
}
