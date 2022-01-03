<?php

declare(strict_types=1);

namespace Tests\Objects;

use Objects\PlainTextObject;
use PHPUnit\Framework\TestCase;

class PlainTextObjectTest extends TestCase
{
    public function testCreate()
    {
        $plainTextObject = PlainTextObject::create(text: 'text', emoji: true);
        $expected = [
            'type' => 'plain_text',
            'text' => 'text',
            'emoji' => true
        ];

        $this->assertSame($expected, $plainTextObject->format());
    }
}
