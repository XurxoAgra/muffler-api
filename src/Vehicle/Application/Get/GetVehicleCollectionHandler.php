<?php

namespace Muffler\Vehicle\Application\Get;

use Muffler\Shared\Application\Support\Paginator\PaginatorInterface;
use Muffler\Vehicle\Domain\Entity\VehicleRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class GetVehicleCollectionHandler
{
    public function __construct(
      private VehicleRepositoryInterface $vehicleRepository
    ) {
    }

    public function __invoke(GetVehicleCollectionCommand $command): PaginatorInterface
    {
        return $this->vehicleRepository->paginate($command->page, $command->limit);
    }
}
