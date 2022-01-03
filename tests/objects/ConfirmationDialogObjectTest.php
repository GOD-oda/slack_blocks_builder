<?php

declare(strict_types=1);

namespace Tests\Objects;

use Objects\ConfirmationDialogObject;
use Objects\PlainTextObject;
use PHPUnit\Framework\TestCase;

class ConfirmationDialogObjectTest extends TestCase
{
    public function testFormat()
    {
        $confirmObject = new ConfirmationDialogObject(
            title: PlainTextObject::create('title'),
            text: PlainTextObject::create('text'),
            confirm: PlainTextObject::create('confirm'),
            deny: PlainTextObject::create('deny')
        );
        $expected = [
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
        ];

        $this->assertSame($expected, $confirmObject->format());
    }
}
