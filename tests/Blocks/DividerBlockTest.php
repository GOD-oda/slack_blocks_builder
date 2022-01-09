<?php

declare(strict_types=1);

namespace SlackBlocksBuilder\Tests\Blocks;

use SlackBlocksBuilder\Blocks\DividerBlock;
use PHPUnit\Framework\TestCase;

class DividerBlockTest extends TestCase
{
    public function testNew()
    {
        $block = new DividerBlock();
        $expected = [
            'type' => 'divider'
        ];

        $this->assertSame($expected, $block->format());

        $block = new DividerBlock('block 1');
        $expected = [
            'type' => 'divider',
            'block_id' => 'block 1'
        ];

        $this->assertSame($expected, $block->format());
    }
}