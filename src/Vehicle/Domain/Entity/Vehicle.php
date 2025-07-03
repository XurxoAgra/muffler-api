<?php

declare(strict_types=1);

namespace Muffler\Vehicle\Domain\Entity;

use Muffler\Vehicle\Domain\ValueObject\Chassis;
use Ramsey\Uuid\UuidInterface;
use Doctrine\ORM\Mapping as ORM;

final class Vehicle implements VehicleInterface
{
    public function __construct(
        #[ORM\Id]
        #[ORM\Column(type: 'uuid', unique: true)]
        private UuidInterface $id,
        #[ORM\Column(name: 'brand', type: 'string', length: 255)]
        private string $brand,
        #[ORM\Column(name: 'model', type: 'string', length: 255)]
        private string $model,
        #[ORM\Column(type: 'integer', nullable: true)]
        private ?int $year,
        #[ORM\Column(type: 'string', length: 17, unique: true, nullable: true)]
        private ?Chassis $chassis,
        #[ORM\Column(name: 'color', type: 'string', length: 255)]
        private ?string $color,
        #[ORM\Column(type: 'datetime_immutable')]
        private \DateTimeImmutable $createdAt,
        #[ORM\Column(type: 'datetime_immutable')]
        private \DateTimeImmutable $updatedAt,
        #[ORM\Column(type: 'datetime_immutable')]
        private ?\DateTimeImmutable $deletedAt,
    ) {
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function setId(UuidInterface $id): void
    {
        $this->id = $id;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): void
    {
        $this->year = $year;
    }

    public function getChassis(): ?Chassis
    {
        return $this->chassis;
    }

    public function setChassis(?Chassis $chassis): void
    {
        $this->chassis = $chassis;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): void
    {
        $this->color = $color;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTimeImmutable $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }
}
