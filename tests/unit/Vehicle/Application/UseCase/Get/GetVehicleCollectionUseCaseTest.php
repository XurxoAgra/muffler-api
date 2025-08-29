<?php

namespace Muffler\Tests\unit\Vehicle\Application\UseCase\Get;

use Muffler\Shared\Application\Support\Paginator\Paginator;
use Muffler\Tests\unit\Vehicle\Application\UseCase\BaseVehicleUseCaseTest;
use Muffler\Vehicle\Application\Collection\GetVehicleCollectionHandler;

class GetVehicleCollectionUseCaseTest extends BaseVehicleUseCaseTest
{
    /**
     * @group Vehicle
     *
     * @return void
     */
    public function testGetVehicleCollectionUseCase(): void
    {
        $command           = $this->getVehicleCollectionCommand();
        $expectedPaginator = new Paginator([], 0, $command->page, $command->limit);

        $this->vehicleRepository
            ->expects($this->once())
            ->method('paginate')
            ->willReturn($expectedPaginator);

        $handler = new GetVehicleCollectionHandler($this->vehicleRepository);
        $result  = $handler($command);

        $this->assertSame($expectedPaginator, $result);
    }
}
