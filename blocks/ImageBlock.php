<?php

declare(strict_types=1);

namespace Blocks;

use Objects\PlainTextObject;

class ImageBlock extends Block
{
    protected string $type = 'image';

    public function __construct(
        protected string $imageUrl,
        protected string $altText,
        protected ?PlainTextObject $title = null,
        protected ?string $blockId = null,
    ) {
        if (mb_strlen($this->imageUrl) > 3000) {
            throw new \InvalidArgumentException('Maximum length of image_url is 3000 characters.');
        }

        if (mb_strlen($this->altText) > 2000) {
            throw new \InvalidArgumentException('Maximum length of alt_text is 2000 characters.');
        }

        if ($title->textLength() > 2000) {
            throw new \InvalidArgumentException('Maximum length of title is 2000 characters.');
        }
    }

    /**
     * @inheritDoc
     */
    public function format(): array
    {
        $res = [
            'type' => $this->type,
            'image_url' => $this->imageUrl,
            'alt_text' => $this->altText
        ];

        if ($this->title !== null) {
            $res['title'] = $this->title->format();
        }

        if ($this->blockId !== null) {
            $res['block_id'] = $this->blockId;
        }

        return $res;
    }
}