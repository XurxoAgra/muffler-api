<?php

declare(strict_types=1);

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
    ) {
    }

    /**
     * @param CreateVehicleCommand $command
     * @return void
     */
    public function __invoke(CreateVehicleCommand $command): void
    {
        $vehicle = new Vehicle(
            id: Uuid::uuid4(),
            brand: $command->getBrand(),
            model: $command->getModel(),
            year: $command->getYear(),
            chassis: $command->getChassis() ? new Chassis($command->chassis) : null,
            color: $command->getColor(),
            createdAt: new \DateTimeImmutable(),
            updatedAt: new \DateTimeImmutable(),
            deletedAt: null,
        );

        $this->vehicleRepository->add($vehicle);
    }
}
