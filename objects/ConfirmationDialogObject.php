<?php

declare(strict_types=1);

namespace Objects;

class ConfirmationDialogObject extends BaseObject
{
    public function __construct(
        protected PlainTextObject $title,
        protected TextObject $text,
        protected PlainTextObject $confirm,
        protected PlainTextObject $deny,
        protected ?string $style = null // TODO: Check invalid style
    ) {}

    /**
     * @inheritDoc
     */
    public function format(): array
    {
        $res = [
            'title' => $this->title->format(),
            'text' => $this->text->format(),
            'confirm' => $this->confirm->format(),
            'deny' => $this->deny->format()
        ];

        if ($this->style !== null) {
            $res['style'] = $this->style;
        }

        return $res;
    }
}