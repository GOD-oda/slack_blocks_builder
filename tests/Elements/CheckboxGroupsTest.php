<?php

declare(strict_types=1);

namespace SlackBlocksBuilder\Tests\Elements;

use SlackBlocksBuilder\Elements\CheckboxGroups;
use PHPUnit\Framework\TestCase;
use SlackBlocksBuilder\Objects\ConfirmationDialogObject;
use SlackBlocksBuilder\Objects\OptionCollection;
use SlackBlocksBuilder\Objects\OptionObject;
use SlackBlocksBuilder\Objects\PlainTextObject;

class CheckboxGroupsTest extends TestCase
{
    public function testFormat()
    {
        $optionObject = new OptionObject(
            text: PlainTextObject::create('foo'),
            value: 'bar'
        );

        $optionCollection = new OptionCollection();
        $optionCollection->add($optionObject);

        $initialOptions = new OptionCollection();
        $initialOptions->add($optionObject);

        $ele = new CheckboxGroups(
            optionCollection: $optionCollection,
            actionId: 'action 1',
            initialOptions: $initialOptions,
            confirm: new ConfirmationDialogObject(
                title: PlainTextObject::create(text: 'title'),
                text: PlainTextObject::create(text: 'text'),
                confirm: PlainTextObject::create(text: 'confirm'),
                deny: PlainTextObject::create(text: 'deny'),
            ),
            focusOnLoad: true
        );
        $expected = [
            'type' => 'checkboxes',
            'options' => [
                [
                    'text' => [
                        'type' => 'plain_text',
                        'text' => 'foo'
                    ],
                    'value' => 'bar'
                ]
            ],
            'action_id' => 'action 1',
            'initial_options' => [
                [
                    'text' => [
                        'type' => 'plain_text',
                        'text' => 'foo'
                    ],
                    'value' => 'bar'
                ]
            ],
            'confirm' => [
                'title' => [
                    'type' => 'plain_text',
                    'text' => 'title'
                ],
                'text' => [
                    'type' => 'plain_text',
                    'text' => 'text'
                ],
                'confirm' => [
                    'type' => 'plain_text',
                    'text' => 'confirm'
                ],
                'deny' => [
                    'type' => 'plain_text',
                    'text' => 'deny'
                ]
            ],
            'focus_on_load' => true
        ];

        $this->assertSame($expected, $ele->format());
    }
}
