<?php

declare(strict_types=1);

namespace SlackBlocksBuilder\Tests\Elements\SelectMenu;

use PHPUnit\Framework\TestCase;
use SlackBlocksBuilder\Elements\SelectMenu\StaticOptions;
use SlackBlocksBuilder\Objects\ConfirmationDialogObject;
use SlackBlocksBuilder\Objects\OptionCollection;
use SlackBlocksBuilder\Objects\OptionObject;
use SlackBlocksBuilder\Objects\PlainTextObject;

class StaticOptionsTest extends TestCase
{

    public function testFormat()
    {
        $option = new OptionObject(
            text: PlainTextObject::create('option text'),
            value: 'value'
        );
        $options = new OptionCollection();
        $options->add($option);
        $ele = new StaticOptions(
            placeholder: PlainTextObject::create('placeholder'),
            options: $options,
            actionId: 'action 1',
            focusOnLoad: true,
            confirmationDialogObject: new ConfirmationDialogObject(
                title: PlainTextObject::create('title'),
                text: PlainTextObject::create('text'),
                confirm: PlainTextObject::create('confirm'),
                deny: PlainTextObject::create('deny')
            ),
            initialOption: $option
        );
        $expected = [
            'placeholder' => [
                'type' => 'plain_text',
                'text' => 'placeholder'
            ],
            'type' => 'static_select',
            'options' => [
                [
                    'text' => [
                        'type' => 'plain_text',
                        'text' => 'option text'
                    ],
                    'value' => 'value'
                ]
            ],
            'action_id' => 'action 1',
            'focus_on_load' => true,
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
            ]
        ];

        $this->assertSame($expected, $ele->format());
    }

    public function testNotIncludeInitialOptionInOptions()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Does not include initialOption in options.');

        $options = new OptionCollection();
        $options->add(
            new OptionObject(
                text: PlainTextObject::create('option text'),
                value: 'value'
            )
        );
        new StaticOptions(
            placeholder: PlainTextObject::create('foo'),
            options: $options,
            initialOption: new OptionObject(
                text: PlainTextObject::create('initial option text'),
                value: 'value'
            )
        );
    }
}
