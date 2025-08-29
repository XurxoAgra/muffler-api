<?php

namespace Muffler\Vehicle\Infrastructure\Controller\Provide\Item;

use Muffler\Shared\Infrastructure\Controller\BaseController;
use Muffler\Vehicle\Application\Item\GetVehicleItemCommand;
use Muffler\Vehicle\Infrastructure\Dto\VehicleDto;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Messenger\Envelope;

#[AsController]
final readonly class VehicleGetItemController extends BaseController
{
    public function __invoke(string $id): JsonResponse
    {
        $vehicle = $this->bus->dispatch(
            new Envelope(new GetVehicleItemCommand(Uuid::fromString($id)))
        );

        return new JsonResponse(VehicleDto::create($vehicle), 200);
    }
}
