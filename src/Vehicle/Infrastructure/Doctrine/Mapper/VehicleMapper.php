<?php

namespace Muffler\Vehicle\Infrastructure\Doctrine\Mapper;
use Muffler\Vehicle\Domain\Entity\Vehicle as DomainVehicle;
use Muffler\Vehicle\Domain\ValueObject\Chassis;
use Muffler\Vehicle\Infrastructure\Doctrine\Entity\Vehicle as DoctrineVehicle;

class VehicleMapper
{
    public function toDomain(DoctrineVehicle $entity): DomainVehicle
    {
        return new DomainVehicle(
            $entity->getId(),
            $entity->getBrand(),
            $entity->getModel(),
            $entity->getYear(),
            new Chassis($entity->getChassis()),
            $entity->getColor(),
            $entity->getCreatedAt(),
            $entity->getUpdatedAt(),
            $entity->getDeletedAt(),
        );
    }

    public function toInfrastructure(DomainVehicle $vehicle): DoctrineVehicle
    {
        return new DoctrineVehicle(
            $vehicle->getId(),
            $vehicle->getBrand(),
            $vehicle->getModel(),
            $vehicle->getYear(),
            $vehicle->getChassis()?->toString(),
            $vehicle->getColor(),
            $vehicle->getCreatedAt(),
            $vehicle->getUpdatedAt(),
            $vehicle->getDeletedAt(),
        );
    }
}
