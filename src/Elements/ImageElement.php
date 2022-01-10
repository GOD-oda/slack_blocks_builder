<?php

declare(strict_types=1);

namespace SlackBlocksBuilder\Elements;

class ImageElement extends Element
{
    protected string $type = 'image';

    public function __construct(
        protected string $imageUrl,
        protected string $altText,
    ) {}

    /**
     * @param string $imageUrl
     * @param string $altText
     * @return $this
     */
    public static function create(string $imageUrl, string $altText): static
    {
        return new static(imageUrl: $imageUrl, altText: $altText);
    }

    /**
     * @inheritDoc
     */
    public function format(): array
    {
        return [
            'type' => $this->type,
            'image_url' => $this->imageUrl,
            'alt_text' => $this->altText
        ];
    }
}