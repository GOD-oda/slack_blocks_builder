<?php

declare(strict_types=1);

namespace Tests\Elements;

use Elements\ButtonElement;
use Objects\ConfirmationDialogObject;
use Objects\ConfirmObject;
use Objects\PlainTextObject;
use PHPUnit\Framework\TestCase;

class ButtonElementTest extends TestCase
{
    public function testFormat()
    {
        $ele = new ButtonElement(
            text: 'text',
            actionId: 'action 1',
            url: 'url',
            value: 'value',
            style: 'style',
            confirm: new ConfirmationDialogObject(
                title: PlainTextObject::create(text: 'title'),
                text: PlainTextObject::create(text: 'text'),
                confirm: PlainTextObject::create(text: 'confirm'),
                deny: PlainTextObject::create(text: 'deny'),
            )
        );
        $expected = [
            'type' => 'button',
            'text' => [
                'type' => 'plain_text',
                'text' => 'text',
            ],
            'action_id' => 'action 1',
            'value' => 'value',
            'url' => 'url',
            'style' => 'style',
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
}
