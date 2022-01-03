<?php

declare(strict_types=1);

namespace Blocks;

use Objects\PlainTextObject;

class HeaderBlock extends Block
{
    protected string $type = 'header';

    public function __construct(
        protected PlainTextObject $text,
        protected ?string $blockId = null
    ) {
        if ($text->textLength() > 150) {
            throw new \InvalidArgumentException('Maximum length of text is 150 characters.');
        }
    }

    /**
     * @inheritDoc
     */
    public function format(): array
    {
        $res = [
            'type' => $this->type,
            'text' => $this->text->format()
        ];

        if ($this->blockId !== null) {
            $res['block_id'] = $this->blockId;
        }

        return $res;
    }
}