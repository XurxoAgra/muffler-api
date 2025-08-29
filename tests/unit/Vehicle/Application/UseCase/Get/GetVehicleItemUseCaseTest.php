<?php

namespace unit\Vehicle\Application\UseCase\Get;

use Muffler\Tests\common\Support\Builder\Vehicle\VehicleBuilder;
use Muffler\Tests\unit\Vehicle\Application\UseCase\BaseVehicleUseCaseTest;
use Muffler\Vehicle\Application\Item\GetVehicleItemCommand;
use Muffler\Vehicle\Application\Item\GetVehicleItemHandler;
use Muffler\Vehicle\Domain\Entity\VehicleInterface;

class GetVehicleItemUseCaseTest extends BaseVehicleUseCaseTest
{
    public function testGetVehicleItemUseCaseTest(): void
    {
        $vehicle = VehicleBuilder::create()->build();

        $command = new GetVehicleItemCommand($vehicle->getId());

        $this->vehicleRepository
            ->expects($this->once())
            ->method('findByIdOrFail')
            ->willReturn($vehicle);

        $handler = new GetVehicleItemHandler(
            $this->vehicleRepository,
        );

        $result = $handler($command);

        self::assertInstanceOf(VehicleInterface::class, $result);
    }
}
