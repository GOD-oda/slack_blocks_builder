<?php

declare(strict_types=1);

namespace SlackBlocksBuilder\Objects;

class OptionCollection implements OptionCollectionInterface
{
    /** @var OptionObject[] */
    protected array $optionObjects = [];

    /**
     * @inheritDoc
     */
    public function add(OptionObject $optionObject): self
    {
        $this->optionObjects[] = $optionObject;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function exclude(OptionObject $optionObject): bool
    {
        return !in_array($optionObject, $this->optionObjects);
    }

    /**
     * @return int
     */
    public function count():int
    {
        return count($this->optionObjects);
    }

    /**
     * @inheritDoc
     */
    public function format(): array
    {
        $res = [];

        foreach ($this->optionObjects as $optionObject) {
            $res[] = $optionObject->format();
        }

        return $res;
    }
}