<?php

declare(strict_types=1);

namespace SlackBlocksBuilder\Tests\Objects;

use SlackBlocksBuilder\Objects\PlainTextObject;
use PHPUnit\Framework\TestCase;

class TextObjectTest extends TestCase
{
    public function testNewPlainTextObject()
    {
        $obj = new PlainTextObject(type: 'plain_text', text: 'text', emoji: true);
        $expected = [
            'type' => 'plain_text',
            'text' => 'text',
            'emoji' => true,
        ];

        $this->assertSame($expected, $obj->format());
    }

    public function testNewMarkdownTextObject()
    {
        $obj = new PlainTextObject(type: 'mrkdwn', text: 'text', verbatim: true);
        $expected = [
            'type' => 'mrkdwn',
            'text' => 'text',
            'verbatim' => true
        ];

        $this->assertSame($expected, $obj->format());
    }

    public function testTextLength()
    {
        $obj = new PlainTextObject(type: 'mrkdwn', text: 'text');
        $this->assertSame(4, $obj->textLength());
    }
}
