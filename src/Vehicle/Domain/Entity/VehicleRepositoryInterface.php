<?php

declare(strict_types=1);

namespace Muffler\Vehicle\Domain\Entity;

use Muffler\Shared\Application\Support\Paginator\PaginatorInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

interface VehicleRepositoryInterface
{
    public function findById(Uuid $id): ?VehicleInterface;

    public function findByIdOrFail(UuidInterface $id): VehicleInterface;

    public function add(Vehicle $vehicle): void;

    public function delete(Vehicle $vehicle): void;

    public function paginate(int $page, int $limit): PaginatorInterface;
}
