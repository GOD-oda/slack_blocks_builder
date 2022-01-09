<?php

declare(strict_types=1);

namespace SlackBlocksBuilder\Objects;

class TextObject extends BaseObject
{
    public function __construct(
        protected string $type, // TODO: Check invalid type
        protected string $text,
        protected ?bool $emoji = null,
        protected ?bool $verbatim = null,
    ) {}

    /**
     * @return int
     */
    public function textLength(): int
    {
        return mb_strlen($this->text);
    }

    /**
     * @inheritDoc
     */
    public function format(): array
    {
        $res = [
            'type' => $this->type,
            'text' => $this->text,
        ];

        return match ($this->type) {
            'plain_text' => array_merge($res, $this->plainTextResponse()),
            'mrkdwn' => array_merge($res, $this->markdownTextResponse()),
        };
    }

    /**
     * @return array
     */
    private function plainTextResponse(): array
    {
        if ($this->emoji === null) {
            return [];
        } else {
            return ['emoji' => $this->emoji];
        }
    }

    /**
     * @return array
     */
    private function markdownTextResponse(): array
    {
        if ($this->verbatim === null) {
            return [];
        } else {
            return ['verbatim' => $this->verbatim];
        }
    }
}