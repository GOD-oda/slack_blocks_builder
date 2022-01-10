<?php

declare(strict_types=1);

namespace SlackBlocksBuilder\Blocks;

use SlackBlocksBuilder\Elements\ImageElement;
use SlackBlocksBuilder\Objects\PlainTextObject;

class ContextBlock extends Block implements ContextBlockInterface
{
    /** @var int  */
    const MAX_ELEMENTS = 10;

    protected string $type = 'context';

    /** @var (TextObject|ImageElement)[] */
    protected array $elements = [];

    public function __construct(protected ?string $blockId = null) {}

    /**
     * @inheritDoc
     */
    public function addPlainTextObject(string $text, ?bool $emoji = null): self
    {
        $this->elements[] = PlainTextObject::create(text: $text, emoji: $emoji);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addImage(string $imageUrl, string $altText): self
    {
        $this->elements[] = ImageElement::create(imageUrl: $imageUrl, altText: $altText);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function format(): array
    {
        if (count($this->elements) > self::MAX_ELEMENTS) {
            throw new \InvalidArgumentException('Maximum length of elements is 10.');
        }

        $elements = [];
        foreach ($this->elements as $element) {
            $elements[] = $element->format();
        }

        $res = [
            'type' => $this->type,
            'elements' => $elements
        ];

        if ($this->blockId) {
            $res['block_id'] = $this->blockId;
        }

        return $res;
    }
}
