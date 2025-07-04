<?php

namespace Muffler\Vehicle\Application\Create;

use Muffler\Vehicle\Domain\Entity\Vehicle;
use Muffler\Vehicle\Domain\Entity\VehicleRepositoryInterface;
use Muffler\Vehicle\Domain\ValueObject\Chassis;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class CreateVehicleHandler
{
    public function __construct(
        private VehicleRepositoryInterface $vehicleRepository,
    ) {}

    public function __invoke(CreateVehicleCommand $command): void
    {
        $now = new \DateTimeImmutable();

        $vehicle = new Vehicle(
            id: Uuid::fromString($command->id),
            brand: $command->brand,
            model: $command->model,
            year: $command->year,
            chassis: $command->chassis ? new Chassis($command->chassis) : null,
            color: $command->color,
            createdAt: $now,
            updatedAt: $now,
            deletedAt: null,
        );

        $this->vehicleRepository->add($vehicle);
    }
}
