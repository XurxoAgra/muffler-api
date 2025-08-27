<?php

namespace Muffler\Vehicle\Infrastructure\Controller\Provide;

use Muffler\Shared\Infrastructure\Controller\BaseController;
use Muffler\Vehicle\Application\Get\GetVehicleCollectionCommand;
use Muffler\Vehicle\Infrastructure\Dto\VehicleDto;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Messenger\Envelope;

#[AsController]
final readonly class VehicleGetCollectionController extends BaseController
{
    public function __invoke(Request $request): JsonResponse
    {
        $page  = max(1, (int) $request->query->get('page', 1));
        $limit = max(1, (int) $request->query->get('limit', 10));

        $response = $this->bus->dispatch(
            new Envelope(new GetVehicleCollectionCommand($page, $limit))
        );

        $vehicles = $response->map(
            fn($vehicle) => VehicleDto::create($vehicle)
        );

        return new JsonResponse($vehicles->toArray());
    }
}
