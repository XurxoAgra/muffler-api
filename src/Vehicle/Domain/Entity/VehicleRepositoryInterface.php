<?php

namespace Muffler\Vehicle\Domain\Entity;

use Ramsey\Uuid\Uuid;

interface VehicleRepositoryInterface
{
    public function find(Uuid $id): ?Vehicle;

    public function save(Vehicle $vehicle): void;

    public function delete(Vehicle $vehicle): void;

    /** @return Vehicle[] */
    public function findAll(): array;
}
