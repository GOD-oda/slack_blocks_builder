<?php

declare(strict_types=1);

namespace SlackBlocksBuilder\Blocks;

interface ContextBlockInterface
{
    /**
     * @param string $text
     * @param bool|null $emoji
     * @return $this
     */
    public function addPlainTextObject(string $text, ?bool $emoji = null): self;

    /**
     * @param string $imageUrl
     * @param string $altText
     * @return $this
     */
    public function addImage(string $imageUrl, string $altText): self;
}