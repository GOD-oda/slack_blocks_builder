<?php

declare(strict_types=1);

namespace Blocks;

abstract class Block
{
    protected string $type;

    protected ?string $blockId = null;

    /**
     * @return array
     */
    abstract public function format(): array;
}