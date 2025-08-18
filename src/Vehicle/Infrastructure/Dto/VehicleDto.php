<?php

declare(strict_types=1);

namespace Muffler\Vehicle\Infrastructure\Dto;

use Muffler\Vehicle\Domain\Entity\VehicleInterface;
use Ramsey\Uuid\UuidInterface;

class VehicleDto
{
    public UuidInterface $id;

    public string $brand;

    public string $model;

    public ?int $year;

    public ?string $chassis;

    public ?string $color;

    public static function create(VehicleInterface $vehicle): self
    {
        $vehicleDto = new self();

        $vehicleDto->id = $vehicle->getId();
        $vehicleDto->brand = $vehicle->getBrand();
        $vehicleDto->model = $vehicle->getModel();
        $vehicleDto->year = $vehicle->getYear();
        $vehicleDto->chassis = $vehicle->getChassis()->value();
        $vehicleDto->color = $vehicle->getColor();

        return $vehicleDto;
    }
}
