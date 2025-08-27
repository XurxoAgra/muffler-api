<?php

namespace Muffler\Tests\unit\Vehicle\Application\UseCase;

use Muffler\Vehicle\Application\Create\CreateVehicleCommand;
use Muffler\Vehicle\Application\Get\GetVehicleCollectionCommand;
use Muffler\Vehicle\Domain\Entity\Vehicle;
use Muffler\Vehicle\Domain\Entity\VehicleRepositoryInterface;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

abstract class BaseVehicleUseCaseTest extends TestCase
{
    protected VehicleRepositoryInterface|MockObject $vehicleRepository;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->vehicleRepository = $this->createMock(VehicleRepositoryInterface::class);
    }

    protected function getCreateVehicleCommandFromVehicle(Vehicle $vehicle): CreateVehicleCommand
    {
        return new CreateVehicleCommand(
            $vehicle->getBrand(),
            $vehicle->getModel(),
            $vehicle->getYear(),
            $vehicle->getChassis()->value(),
            $vehicle->getColor(),
        );
    }

    protected function getVehicleCollectionCommand(): GetVehicleCollectionCommand
    {
        return new GetVehicleCollectionCommand(
            2,
            2,
        );
    }
}
