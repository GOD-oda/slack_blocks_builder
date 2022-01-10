<?php

declare(strict_types=1);

namespace SlackBlocksBuilder\Tests\Objects;

use PHPUnit\Framework\TestCase;
use SlackBlocksBuilder\Objects\OptionCollection;
use SlackBlocksBuilder\Objects\OptionObject;
use SlackBlocksBuilder\Objects\PlainTextObject;

class OptionCollectionTest extends TestCase
{
    protected OptionCollection $options;

    protected function setUp(): void
    {
        $this->options = new OptionCollection();
    }

    public function testFormat()
    {
        $this->options->add(new OptionObject(
            text: PlainTextObject::create('text'),
            value: 'value'
        ));
        $expected = [
            [
                'text' => [
                    'type' => 'plain_text',
                    'text' => 'text'
                ],
                'value' => 'value'
            ]
        ];

        $this->assertSame($expected, $this->options->format());
    }

    public function testExclude()
    {
        $this->options->add(new OptionObject(
            text: PlainTextObject::create('text'),
            value: 'value'
        ));

        $otherOption = new OptionObject(
            text: PlainTextObject::create('other'),
            value: 'value'
        );

        $this->assertTrue($this->options->exclude($otherOption));
    }

    public function testCount()
    {
        $this->options->add(new OptionObject(
            text: PlainTextObject::create('text'),
            value: 'value'
        ));

        $this->assertSame(1, $this->options->count());
    }
}
