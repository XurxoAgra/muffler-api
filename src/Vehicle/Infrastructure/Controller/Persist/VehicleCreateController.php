<?php

declare(strict_types=1);

namespace Muffler\Vehicle\Infrastructure\Controller\Persist;

use Muffler\Vehicle\Application\Create\CreateVehicleCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsController]
final readonly class VehicleCreateController
{
    public function __construct(
        private MessageBusInterface $messageBus,
    ) {
    }

    /**
     * @throws ExceptionInterface
     */
    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!$data || !isset($data['brand'], $data['model'])) {
            throw new BadRequestHttpException('Invalid JSON payload. Required: brand, model');
        }

        $command = new CreateVehicleCommand(
            brand: $data['brand'],
            model: $data['model'],
            year: isset($data['year']) ? (int) $data['year'] : null,
            chassis: $data['chassis'] ?? null,
            color: $data['color'] ?? null,
        );

        $this->messageBus->dispatch($command);

        return new JsonResponse(['message' => 'Vehicle created'], Response::HTTP_CREATED);
    }
}
