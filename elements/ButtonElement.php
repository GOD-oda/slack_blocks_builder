<?php

declare(strict_types=1);

namespace Elements;

use Objects\ConfirmationDialogObject;
use Objects\PlainTextObject;

class ButtonElement extends Element
{
    /** @var string  */
    protected string $type = 'button';

    /**
     * @param string $text
     * @param string|null $actionId
     * @param string|null $url
     * @param string|null $value
     * @param string|null $style
     * @param ConfirmationDialogObject|null $confirm
     */
    public function __construct(
        protected string $text,
        protected ?string $actionId,
        protected ?string $url = null,
        protected ?string $value = null,
        protected ?string $style = null,// TODO: Check invalid style
        protected ?ConfirmationDialogObject $confirm = null
    ) {}

    /**
     * @return array
     */
    public function format(): array
    {
        $format = [
            'type' => $this->type,
            'text' => PlainTextObject::create(text: $this->text)->format(),
            'action_id' => $this->actionId
        ];

        if ($this->actionId) {
            $format['action_id'] = $this->actionId;
        }

        if ($this->value) {
            $format['value'] = $this->value;
        }

        if ($this->url) {
            $format['url'] = $this->url;
        }

        if ($this->style) {
            $format['style'] = $this->style;
        }

        if ($this->confirm) {
            $format['confirm'] = $this->confirm->format();
        }

        return $format;
    }
}