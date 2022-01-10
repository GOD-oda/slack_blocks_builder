<?php

namespace SlackBlocksBuilder\Tests\Objects;

use SlackBlocksBuilder\Objects\OptionCollection;
use PHPUnit\Framework\TestCase;
use SlackBlocksBuilder\Objects\OptionGroupObject;
use SlackBlocksBuilder\Objects\OptionObject;
use SlackBlocksBuilder\Objects\PlainTextObject;

class OptionGroupObjectTest extends TestCase
{

    public function testFormat()
    {
        $collection = new OptionCollection();
        $collection->add(new OptionObject(
            text: PlainTextObject::create('text'),
            value: 'value'
        ));
        $obj = new OptionGroupObject(
            label: 'label',
            optionCollection: $collection
        );
        $expected = [
            'label' => 'label',
            'options' => [
                [
                    'text' => [
                        'type' => 'plain_text',
                        'text' => 'text'
                    ],
                    'value' => 'value'
                ]
            ]
        ];

        $this->assertSame($expected, $obj->format());
    }

    public function testInvalidCollectionCount()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Maximum number of optionCollection is 100.');

        $max = 101;
        $collection = new OptionCollection();
        $option = new OptionObject(
            text: PlainTextObject::create('text'),
            value: 'value'
        );
        for ($i = 0; $i < $max; $i++) {
          $collection->add($option);
        }
        new OptionGroupObject(
            label: 'label',
            optionCollection: $collection
        );
    }
}
