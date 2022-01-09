<?php

declare(strict_types=1);

namespace SlackBlocksBuilder\Tests\Blocks;

use SlackBlocksBuilder\Blocks\ActionsBlock;
use SlackBlocksBuilder\Objects\ConfirmationDialogObject;
use SlackBlocksBuilder\Objects\PlainTextObject;
use PHPUnit\Framework\TestCase;

class ActionsBlockTest extends TestCase
{
    public function testMaximumElements()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Maximum length of elements is 5.');

        $elementsCount = 6;
        $block = new ActionsBlock();
        for ($i = 0; $i < $elementsCount; $i++) {
            $block->addButtonElement('a');
        }

        $block->format();
    }

    public function testAddButtonElement()
    {
         $confirmObject = new ConfirmationDialogObject(
            title: PlainTextObject::create('title'),
            text: PlainTextObject::create('text'),
            confirm: PlainTextObject::create('confirm'),
            deny: PlainTextObject::create('deny')
        );

        $block = new ActionsBlock(blockId: 'block 1');
        $block->addButtonElement(
            text: 'text',
            actionId: 'action 1',
            url: 'url',
            value: 'value',
            style: 'style',
            confirm: $confirmObject
        );
        $expected = [
            'type' => 'actions',
            'elements' => [
                [
                    'type' => 'button',
                    'text' => [
                        'type' => 'plain_text',
                        'text' => 'text'
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
                ]
            ],
            'block_id' => 'block 1'
        ];

        $this->assertSame($expected, $block->format());
    }
}
