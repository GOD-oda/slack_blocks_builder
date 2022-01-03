<?php

declare(strict_types=1);

namespace Blocks;

use Elements\ButtonElement;
use Elements\Element;
use Objects\ConfirmationDialogObject;

class ActionsBlock extends Block implements ActionsBlockInterface
{
    protected string $type = 'actions';

    /** @var Element[]  */
    protected array $elements = [];

    public function __construct(
        protected ?string $blockId = null
    ) {}


    /**
     * @inheritDoc
     */
    public function addButtonElement(string $text, ?string $actionId = null, ?string $url = null, ?string $value = null, ?string $style = null, ?ConfirmationDialogObject $confirm = null): self
    {
        $this->elements[] = new ButtonElement(
            text: $text,
            actionId: $actionId,
            url: $url,
            value: $value,
            style: $style,
            confirm: $confirm
        );

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function format(): array
    {
        $elements = [];

        if (count($this->elements) > 5) {
            throw new \InvalidArgumentException('Maximum length of elements is 5.');
        }

        foreach ($this->elements as $element) {
            $elements[] = $element->format();
        }

        $format = [
            'type' => $this->type,
            'elements' => $elements
        ];

        if ($this->blockId) {
            $format['block_id'] = $this->blockId;
        }

        return $format;
    }
}