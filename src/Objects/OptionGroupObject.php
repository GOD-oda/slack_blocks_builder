<?php

declare(strict_types=1);

namespace SlackBlocksBuilder\Objects;

class OptionGroupObject extends BaseObject
{
    public function __construct(
        protected string $label,
        protected OptionCollection $optionCollection
    ) {
        if ($optionCollection->count() > 100) {
            throw new \InvalidArgumentException('Maximum number of optionCollection is 100.');
        }
    }

    /**
     * @inheritDoc
     */
    public function format(): array
    {
        return [
            'label' => $this->label,
            'options' => $this->optionCollection->format()
        ];
    }
}