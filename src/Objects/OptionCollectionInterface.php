<?php

declare(strict_types=1);

namespace SlackBlocksBuilder\Objects;

interface OptionCollectionInterface
{
    /**
     * @param OptionObject $optionObject
     * @return $this
     */
    public function add(OptionObject $optionObject): self;

    /**
     * @param OptionObject $optionObject
     * @return bool
     */
    public function exclude(OptionObject $optionObject): bool;

    /**
     * @return int
     */
    public function count(): int;

    /**
     * @return array
     */
    public function format(): array;
}