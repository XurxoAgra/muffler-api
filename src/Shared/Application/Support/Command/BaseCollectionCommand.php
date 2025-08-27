<?php

namespace Muffler\Shared\Application\Support\Command;

class BaseCollectionCommand
{
    public function __construct(
        public readonly int $page,
        public readonly int $limit
    ) {}
}
