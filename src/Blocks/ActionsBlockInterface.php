<?php

declare(strict_types=1);

namespace SlackBlocksBuilder\Blocks;

use SlackBlocksBuilder\Objects\ConfirmationDialogObject;

interface ActionsBlockInterface
{
    /**
     * @param string $text
     * @param string|null $actionId
     * @param string|null $url
     * @param string|null $value
     * @param string|null $style
     * @param ConfirmationDialogObject|null $confirm
     * @return self
     */
    public function addButtonElement(string $text, ?string $actionId = null, ?string $url = null, ?string $value = null, ?string $style = null, ?ConfirmationDialogObject $confirm = null): self;
}