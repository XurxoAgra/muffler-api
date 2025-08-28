<?php

namespace Muffler\Vehicle\Application\Item;

use Muffler\Vehicle\Domain\Entity\VehicleRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class GetVehicleItemHandler
{
    /**
     * @param VehicleRepositoryInterface $vehicleRepository
     */
    public function __construct(
      private VehicleRepositoryInterface $vehicleRepository
    ) {
    }

    /**
     * @param GetVehicleItemCommand $command
     */
    public function __invoke(GetVehicleItemCommand $command)
    {
        return $this->vehicleRepository->findById($command->getId());
    }
}
