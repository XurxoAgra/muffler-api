<?php

namespace Muffler\Vehicle\Application\Item;

use Ramsey\Uuid\UuidInterface;

class GetVehicleItemCommand
{
    public function __construct(
        protected UuidInterface $id
    ) {
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }
}
