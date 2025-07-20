<?php

namespace Muffler\Tests\Unit\Vehicle\Application\UseCase;

use Muffler\Tests\common\Support\Builder\Vehicle\VehicleBuilder;
use Muffler\Vehicle\Application\Create\CreateVehicleHandler;
use Muffler\Vehicle\Domain\Entity\Vehicle;

class CreateVehicleUseCaseTest extends BaseVehicleUseCaseTest
{
    /**
     * @group Vehicle
     *
     * @return void
     */
    public function testCreateVehicleUseCase(): void
    {
        $vehicle = VehicleBuilder::create()->build();
        $command = $this->getCreateVehicleCommandFromVehicle($vehicle);
        $handler = new CreateVehicleHandler(
            $this->vehicleRepository
        );

        $vehicleResult = $handler($command);

        self::assertInstanceOf(Vehicle::class, $vehicleResult);
        self::assertNotNull($vehicleResult->getId());
        self::assertNotNull($vehicleResult->getBrand());
        self::assertNotNull($vehicleResult->getModel());
    }
}
