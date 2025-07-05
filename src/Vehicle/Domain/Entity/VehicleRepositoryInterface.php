<?php

declare(strict_types=1);

namespace Muffler\Vehicle\Domain\Entity;

use Ramsey\Uuid\Uuid;

interface VehicleRepositoryInterface
{
    public function findById(Uuid $id): ?VehicleInterface;

    public function add(VehicleInterface $vehicle): void;

    public function delete(VehicleInterface $vehicle): void;
}
