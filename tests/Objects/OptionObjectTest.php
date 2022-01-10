<?php

declare(strict_types=1);

namespace SlackBlocksBuilder\Tests\Objects;

use SlackBlocksBuilder\Objects\OptionObject;
use SlackBlocksBuilder\Objects\PlainTextObject;
use PHPUnit\Framework\TestCase;

class OptionObjectTest extends TestCase
{
    public function testFormat()
    {
        $obj = new OptionObject(
            text: PlainTextObject::create('text'),
            value: 'value',
            description: PlainTextObject::create('description'),
            url: 'https://sample.com'
        );
        $expected = [
            'text' => [
                'type' => 'plain_text',
                'text' => 'text'
            ],
            'value' => 'value',
            'description' => [
                'type' => 'plain_text',
                'text' => 'description'
            ],
            'url' => 'https://sample.com'
        ];

        $this->assertSame($expected, $obj->format());
    }

    public function testInvalidTextLength()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Maximum length of text is 75 characters.');

        $invalidText = str_repeat('a', 76);

        new OptionObject(
            text: PlainTextObject::create($invalidText),
            value: 'value',
            description: PlainTextObject::create('description'),
            url: 'https://sample.com'
        );
    }

    public function testInvalidValueLength()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Maximum length of value is 75 characters.');

        $invalidValue = str_repeat('a', 76);

        new OptionObject(
            text: PlainTextObject::create('text'),
            value: $invalidValue,
        );
    }

    public function testInvalidDescriptionLength()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Maximum length of description is 75 characters.');

        $invalidDescription = str_repeat('a', 76);

        new OptionObject(
            text: PlainTextObject::create('text'),
            value: 'value',
            description: PlainTextObject::create($invalidDescription),
        );
    }

    public function testInvalidUrlLength()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Maximum length of url is 3000 characters.');

        $invalidUrl = str_repeat('a', 3001);

        new OptionObject(
            text: PlainTextObject::create('text'),
            value: 'value',
            url: $invalidUrl
        );
    }
}
