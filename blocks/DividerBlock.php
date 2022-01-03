<?php

declare(strict_types=1);

namespace Blocks;

class DividerBlock extends Block
{
    protected string $type = 'divider';

    public function __construct(protected ?string $blockId = null) {}

    /**
     * @inheritDoc
     */
    public function format(): array
    {
        $format = [
            'type' => $this->type
        ];

        if ($this->blockId !== null) {
            $format['block_id'] = $this->blockId;
        }

        return $format;
    }
}