<?php

namespace Muffler\Shared\Application\Support\Paginator;

interface PaginatorInterface
{
    public function getItems(): array;
    public function getTotal(): int;
    public function getPage(): int;
    public function getLimit(): int;
    public function map(callable $fn): self;
    public function toArray(): array;
}
