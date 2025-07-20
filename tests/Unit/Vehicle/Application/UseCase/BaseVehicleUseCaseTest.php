<?php

namespace Muffler\Tests\Unit\Vehicle\Application\UseCase;

use Muffler\Vehicle\Application\Create\CreateVehicleCommand;
use Muffler\Vehicle\Domain\Entity\Vehicle;
use Muffler\Vehicle\Domain\Entity\VehicleRepositoryInterface;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class BaseVehicleUseCaseTest extends TestCase
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
}
