<?php

declare(strict_types=1);

namespace Muffler\Vehicle\Domain\Entity;

use Muffler\Vehicle\Domain\ValueObject\Chassis;
use Ramsey\Uuid\UuidInterface;

final readonly class Vehicle
{
    public function __construct(
        private UuidInterface $uuid,
        private string $brand,
        private string $model,
        private ?int $year,
        private ?Chassis $chassis,
        private ?string $color,
        private \DateTimeImmutable $createdAt,
        private \DateTimeImmutable $updatedAt,
        private ?\DateTimeImmutable $deletedAt,
    ) {
    }

    public function getId(): UuidInterface
    {
        return $this->uuid;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function getChassis(): ?Chassis
    {
        return $this->chassis;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }
}
