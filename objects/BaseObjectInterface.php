<?php

declare(strict_types=1);

namespace Objects;

interface BaseObjectInterface
{
    /**
     * @return array
     */
    public function format(): array;
}