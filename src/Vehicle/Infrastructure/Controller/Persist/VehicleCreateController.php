<?php

declare(strict_types=1);

namespace Muffler\Vehicle\Infrastructure\Controller\Persist;

use Muffler\Shared\Infrastructure\Controller\BaseController;
use Muffler\Vehicle\Application\Create\CreateVehicleCommand;
use Muffler\Vehicle\Infrastructure\Dto\VehicleDto;
use Muffler\Vehicle\Infrastructure\Validation\Constraints\VehicleConstraints;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Messenger\Exception\ExceptionInterface;

#[AsController]
final readonly class VehicleCreateController extends BaseController
{
    /**
     * @throws ExceptionInterface
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function __invoke(Request $request): JsonResponse
    {
        $validationGroups = [
            VehicleConstraints::POST_GROUP
        ];

        $vehicleDto = $this->validateRequest($request, VehicleDto::class, $validationGroups);

        $command = new CreateVehicleCommand(
            brand: $vehicleDto->brand,
            model: $vehicleDto->model,
            year: $vehicleDto->year,
            chassis: $vehicleDto->chassis,
            color: $vehicleDto->color,
        );

        $this->bus->dispatch($command);

        return new JsonResponse(Response::HTTP_CREATED);
    }
}
