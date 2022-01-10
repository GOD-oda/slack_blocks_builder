<?php

declare(strict_types=1);

namespace SlackBlocksBuilder\Objects;

class OptionObject extends BaseObject
{
    public function __construct(
        protected TextObject $text,
        protected string $value,
        protected ?PlainTextObject $description = null,
        protected ?string $url = null,
    ) {
        if ($text->textLength() > 75) {
            throw new \InvalidArgumentException('Maximum length of text is 75 characters.');
        }

        if (mb_strlen($value) > 75) {
            throw new \InvalidArgumentException('Maximum length of value is 75 characters.');
        }

        if ($description && $description->textLength() > 75) {
            throw new \InvalidArgumentException('Maximum length of description is 75 characters.');
        }

        if ($url && mb_strlen($url) > 3000) {
            throw new \InvalidArgumentException('Maximum length of url is 3000 characters.');
        }
    }

    public function format(): array
    {
        $res = [
            'text' => $this->text->format(),
            'value' => $this->value
        ];

        if ($this->description) {
            $res['description'] = $this->description->format();
        }

        if ($this->url) {
            $res['url'] = $this->url;
        }

        return $res;
    }
}