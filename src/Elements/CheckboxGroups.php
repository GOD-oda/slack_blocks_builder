<?php

declare(strict_types=1);

namespace SlackBlocksBuilder\Elements;

use SlackBlocksBuilder\Objects\ConfirmationDialogObject;
use SlackBlocksBuilder\Objects\OptionCollection;

class CheckboxGroups extends Element
{
    protected string $type = 'checkboxes';

    /**
     * @inheritDoc
     */
    public function __construct(
        protected OptionCollection $optionCollection,
        protected ?string $actionId = null,
        protected ?OptionCollection $initialOptions = null,
        protected ?ConfirmationDialogObject $confirm = null,
        protected ?bool $focusOnLoad = null
    ) {
        // TODO: check initialOptions
    }

    /**
     * @inheritDoc
     */
    public function format(): array
    {
        $res = [
            'type' => $this->type,
            'options' => $this->optionCollection->format()
        ];

        if ($this->actionId) {
            $res['action_id'] = $this->actionId;
        }

        if (!empty($this->initialOptions)) {
            $res['initial_options'] = $this->initialOptions->format();
        }

        if ($this->confirm) {
            $res['confirm'] = $this->confirm->format();
        }

        if ($this->focusOnLoad !== null) {
            $res['focus_on_load'] = $this->focusOnLoad;
        }

        return $res;
    }
}