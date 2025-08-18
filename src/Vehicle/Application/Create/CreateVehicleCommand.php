<?php

declare(strict_types=1);

namespace Muffler\Vehicle\Application\Create;

readonly class CreateVehicleCommand
{
    public function __construct(
        public string $brand,
        public string $model,
        public ?int $year,
        public ?string $chassis,
        public ?string $color,
    ) {
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function getChassis(): ?string
    {
        return $this->chassis;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }
}
