<?php

namespace SlackBlocksBuilder\Tests\Blocks;

use SlackBlocksBuilder\Blocks\ImageBlock;
use SlackBlocksBuilder\Objects\PlainTextObject;
use PHPUnit\Framework\TestCase;

class ImageBlockTest extends TestCase
{
    public function testFormat()
    {
        $title = PlainTextObject::create('title');
        $block = new ImageBlock(
            imageUrl: 'foo.png',
            altText: 'alt text',
            title: $title,
            blockId: 'block 1'
        );
        $expected = [
            'type' => 'image',
            'image_url' => 'foo.png',
            'alt_text' => 'alt text',
            'title' => [
                'type' => 'plain_text',
                'text' => 'title'
            ],
            'block_id' => 'block 1',
        ];

        $this->assertSame($expected, $block->format());
    }

    public function testMaximumImageUrlLength()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Maximum length of image_url is 3000 characters.');

        $invalidImageUrl = str_repeat('a', 3001);
        new ImageBlock(
            imageUrl: $invalidImageUrl,
            altText: 'alt text',
        );
    }

    public function testMaximumAltTextLength()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Maximum length of alt_text is 2000 characters.');

        $invalidAltText = str_repeat('a', 2001);
        new ImageBlock(
            imageUrl: 'foo.png',
            altText: $invalidAltText,
        );
    }

    public function testMaximumTitleLength()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Maximum length of title is 2000 characters.');

        $invalidTitle = str_repeat('a', 2001);
        $title = PlainTextObject::create($invalidTitle);
        new ImageBlock(
            imageUrl: 'foo.png',
            altText: 'alt text',
            title: $title
        );
    }
}
