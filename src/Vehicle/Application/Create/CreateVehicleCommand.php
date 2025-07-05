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
}
