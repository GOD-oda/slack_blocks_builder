<?php

declare(strict_types=1);

namespace Objects;

class PlainTextObject extends TextObject
{
    /**
     * TODO: use interface or abstract?
     *
     * @param string $text
     * @param bool $emoji
     * @return static
     */
    public static function create(
        string $text,
        ?bool $emoji = null
    ): static {
        return new static(type: 'plain_text', text: $text, emoji: $emoji);
    }
}