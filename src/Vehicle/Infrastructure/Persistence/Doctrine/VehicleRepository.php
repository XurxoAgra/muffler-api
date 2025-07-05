<?php

declare(strict_types=1);

namespace Muffler\Vehicle\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Muffler\Shared\Domain\Exception\NotFoundException;
use Muffler\Vehicle\Domain\Entity\VehicleInterface;
use Muffler\Vehicle\Domain\Entity\VehicleRepositoryInterface;
use Ramsey\Uuid\UuidInterface;

readonly class VehicleRepository implements VehicleRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {
    }

    public function findById(UuidInterface $id): ?VehicleInterface
    {
        $vehicle = $this->em->getRepository(VehicleInterface::class)->find($id);

        return $vehicle instanceof VehicleInterface ? $vehicle : null;
    }

    public function findByIdOrFail(UuidInterface $id): VehicleInterface
    {
        $vehicle = $this->findById($id);

        if (!($vehicle instanceof VehicleInterface)) {
            throw NotFoundException::withIdentifier(VehicleInterface::class, $id);
        }

        return $vehicle;
    }

    public function add(VehicleInterface $vehicle): void
    {
        $this->em->persist($vehicle);
        $this->em->flush();
    }

    public function update(VehicleInterface $vehicle): void
    {
        if (null === $this->findByIdOrFail($vehicle->getId())) {
            throw NotFoundException::withIdentifier(VehicleInterface::class, $vehicle->getId());
        }

        $this->em->persist($vehicle);
    }

    public function delete(VehicleInterface $vehicle): void
    {
        $vehicle = $this->em->getRepository(VehicleInterface::class)->find($vehicle->getId());

        if ($vehicle) {
            $this->em->remove($vehicle);
            $this->em->flush();
        }
    }
}
