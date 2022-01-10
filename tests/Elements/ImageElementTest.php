<?php

declare(strict_types=1);

namespace SlackBlocksBuilder\Tests\Elements;

use SlackBlocksBuilder\Elements\ImageElement;
use PHPUnit\Framework\TestCase;

class ImageElementTest extends TestCase
{

    public function testFormat()
    {
        $ele = new ImageElement(
            imageUrl: 'foo.png',
            altText: 'alt text'
        );
        $expected = [
            'type' => 'image',
            'image_url' => 'foo.png',
            'alt_text' => 'alt text'
        ];

        $this->assertSame($expected, $ele->format());
    }
}
