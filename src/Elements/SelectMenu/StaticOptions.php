<?php

declare(strict_types=1);

namespace SlackBlocksBuilder\Elements\SelectMenu;

use SlackBlocksBuilder\Elements\Element;
use SlackBlocksBuilder\Objects\ConfirmationDialogObject;
use SlackBlocksBuilder\Objects\OptionCollection;
use SlackBlocksBuilder\Objects\OptionGroupObject;
use SlackBlocksBuilder\Objects\OptionObject;
use SlackBlocksBuilder\Objects\PlainTextObject;

class StaticOptions extends Element
{
    protected string $type = 'static_select';

    public function __construct(
        protected PlainTextObject $placeholder,
        protected OptionCollection $options,
        protected ?string $actionId = null,
        protected ?OptionGroupObject $optionGroups = null,
        protected ?OptionObject $initialOption = null,
        protected ?ConfirmationDialogObject $confirmationDialogObject = null,
        protected ?bool $focusOnLoad = null
    ) {
        if ($initialOption && $options->exclude($initialOption)) {
            throw new \InvalidArgumentException('Does not include initialOption in options.');
        }
    }

    /**
     * @inheritDoc
     */
    public function format(): array
    {
        $res = [
            'placeholder' => $this->placeholder->format(),
            'type' => $this->type,
            'options' => $this->options->format()
        ];

        if ($this->actionId) {
            $res['action_id'] = $this->actionId;
        }

        if ($this->focusOnLoad !== null) {
            $res['focus_on_load'] = $this->focusOnLoad;
        }

        if ($this->confirmationDialogObject) {
            $res['confirm'] = $this->confirmationDialogObject->format();
        }

        return $res;
    }
}