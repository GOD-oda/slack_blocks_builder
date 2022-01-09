<?php

declare(strict_types=1);

namespace SlackBlocksBuilder\Elements;

abstract class Element
{
    protected string $type;

    /**
     * @return array
     */
    abstract public function format(): array;
}