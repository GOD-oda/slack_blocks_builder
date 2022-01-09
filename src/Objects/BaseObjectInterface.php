<?php

declare(strict_types=1);

namespace SlackBlocksBuilder\Objects;

interface BaseObjectInterface
{
    /**
     * @return array
     */
    public function format(): array;
}