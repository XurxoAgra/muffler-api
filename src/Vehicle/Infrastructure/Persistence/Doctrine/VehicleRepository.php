<?php

declare(strict_types=1);

namespace Muffler\Vehicle\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Muffler\Shared\Application\Support\Paginator\Paginator;
use Muffler\Shared\Application\Support\Paginator\PaginatorInterface;
use Muffler\Shared\Domain\Exception\NotFoundException;
use Muffler\Vehicle\Domain\Entity\Vehicle;
use Muffler\Vehicle\Domain\Entity\VehicleRepositoryInterface;
use Ramsey\Uuid\UuidInterface;

class VehicleRepository extends ServiceEntityRepository implements VehicleRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicle::class);
    }

    public function findById(UuidInterface $id): ?Vehicle
    {
        $vehicle = $this->getEntityManager()->getRepository(Vehicle::class)->find($id);

        return $vehicle instanceof Vehicle ? $vehicle : null;
    }

    public function findByIdOrFail(UuidInterface $id): Vehicle
    {
        $vehicle = $this->findOneBy(['id' => $id]);

        if (!($vehicle instanceof Vehicle)) {
            throw NotFoundException::withIdentifier(Vehicle::class, $id->toString());
        }

        return $vehicle;
    }

    public function add(Vehicle $vehicle): void
    {
        $this->getEntityManager()->persist($vehicle);
        $this->getEntityManager()->flush();
    }

    public function update(Vehicle $vehicle): void
    {
        if (null === $this->findByIdOrFail($vehicle->getId())) {
            throw NotFoundException::withIdentifier(Vehicle::class, $vehicle->getId()->toString());
        }

        $this->getEntityManager()->persist($vehicle);
        $this->getEntityManager()->flush();
    }

    public function paginate(int $page, int $limit): PaginatorInterface
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('vehicle')
            ->from(Vehicle::class, 'vehicle')
            ->orderBy('vehicle.id', 'ASC')
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit);

        $items = $qb->getQuery()->getResult();

        $count = $this->getEntityManager()->createQueryBuilder()
            ->select('COUNT(v.id)')
            ->from(Vehicle::class, 'v')
            ->getQuery()
            ->getSingleScalarResult();

        return new Paginator($items, (int)$count, $page, $limit);
    }

    public function delete(Vehicle $vehicle): void
    {
        $vehicle = $this->getEntityManager()->getRepository(Vehicle::class)->find($vehicle->getId());

        if ($vehicle) {
            $this->getEntityManager()->remove($vehicle);
            $this->getEntityManager()->flush();
        }
    }
}
