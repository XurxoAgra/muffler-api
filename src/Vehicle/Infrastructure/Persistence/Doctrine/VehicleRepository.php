<?php

declare(strict_types=1);

namespace Muffler\Vehicle\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Muffler\Shared\Application\Support\Paginator\Paginator;
use Muffler\Shared\Application\Support\Paginator\PaginatorInterface;
use Muffler\Shared\Domain\Exception\NotFoundException;
use Muffler\Vehicle\Domain\Entity\Vehicle;
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
            throw NotFoundException::withIdentifier(VehicleInterface::class, $id->toString());
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
            throw NotFoundException::withIdentifier(VehicleInterface::class, $vehicle->getId()->toString());
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

    public function paginate(int $page, int $limit): PaginatorInterface
    {
        $qb = $this->em->createQueryBuilder();

        $qb->select('vehicle')
            ->from(Vehicle::class, 'vehicle')
            ->orderBy('vehicle.id', 'ASC')
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit);

        $items = $qb->getQuery()->getResult();

        $count = $this->em->createQueryBuilder()
            ->select('COUNT(v.id)')
            ->from(Vehicle::class, 'v')
            ->getQuery()
            ->getSingleScalarResult();

        return new Paginator($items, (int) $count, $page, $limit);
    }
}
