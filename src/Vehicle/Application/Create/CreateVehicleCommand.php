<?php

namespace Muffler\Vehicle\Application\Create;

use Ramsey\Uuid\Uuid;

readonly class CreateVehicleCommand
{
    public function __construct(
        public string  $id,
        public string  $brand,
        public string  $model,
        public ?int    $year,
        public ?string $chassis,
        public ?string $color,
    ) {
        Uuid::fromString($this->id);
    }
}
