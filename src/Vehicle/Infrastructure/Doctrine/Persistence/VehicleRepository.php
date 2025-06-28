<?php

namespace Muffler\Vehicle\Infrastructure\Doctrine\Persistence;

use Muffler\Vehicle\Domain\Entity\Vehicle;
use Muffler\Vehicle\Domain\Entity\VehicleRepositoryInterface;
use Ramsey\Uuid\Uuid;

class VehicleRepository implements VehicleRepositoryInterface
{

    public function find(Uuid $id): ?Vehicle
    {
        // TODO: Implement find() method.
    }

    public function save(Vehicle $vehicle): void
    {
        // TODO: Implement save() method.
    }

    public function delete(Vehicle $vehicle): void
    {
        // TODO: Implement delete() method.
    }

    public function findAll(): array
    {
        // TODO: Implement findAll() method.
    }
}
