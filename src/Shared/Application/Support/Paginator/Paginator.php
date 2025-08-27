<?php

namespace Muffler\Shared\Application\Support\Paginator;

readonly class Paginator implements PaginatorInterface
{
    public function __construct(
        private array $items,
        private int   $total,
        private int   $page,
        private int   $limit
    ) {}

    public function getItems(): array
    {
        return $this->items;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function map(callable $fn): self
    {
        return new self(
            array_map($fn, $this->items),
            $this->total,
            $this->page,
            $this->limit
        );
    }

    public function toArray(): array
    {
        return [
            'items' => $this->items,
            'total' => $this->total,
            'page' => $this->page,
            'limit' => $this->limit,
        ];
    }
}
