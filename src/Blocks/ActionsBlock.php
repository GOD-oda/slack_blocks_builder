<?php

declare(strict_types=1);

namespace SlackBlocksBuilder\Blocks;

use SlackBlocksBuilder\Elements\ButtonElement;
use SlackBlocksBuilder\Elements\CheckboxGroups;
use SlackBlocksBuilder\Elements\Element;
use SlackBlocksBuilder\Objects\ConfirmationDialogObject;
use SlackBlocksBuilder\Objects\OptionCollection;

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
    public function addCheckBoxGroups(OptionCollection $optionCollection, ?string $actionId = null, ?OptionCollection $initialOptions = null, ?ConfirmationDialogObject $confirm = null, ?bool $focusOnLoad = null): ActionsBlockInterface
    {
        $this->elements[] = new CheckboxGroups(
            optionCollection: $optionCollection,
            actionId: $actionId,
            initialOptions: $initialOptions,
            confirm: $confirm,
            focusOnLoad: $focusOnLoad
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