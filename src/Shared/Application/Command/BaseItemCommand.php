<?php

namespace Muffler\Shared\Application\Command;

use Ramsey\Uuid\UuidInterface;

readonly class BaseItemCommand
{
    public function __construct(
        public UuidInterface $id,
    ) {}

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }
}
