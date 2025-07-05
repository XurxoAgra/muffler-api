<?php

declare(strict_types=1);

namespace Muffler\Vehicle\Domain\Entity;

use Muffler\Vehicle\Domain\ValueObject\Chassis;
use Ramsey\Uuid\UuidInterface;

interface VehicleInterface
{
    public function getId(): UuidInterface;

    public function setId(UuidInterface $id): void;

    public function getBrand(): string;

    public function setBrand(string $brand): void;

    public function getModel(): string;

    public function setModel(string $model): void;

    public function getYear(): ?int;

    public function setYear(?int $year): void;

    public function getChassis(): ?Chassis;

    public function setChassis(?Chassis $chassis): void;

    public function getColor(): ?string;

    public function setColor(?string $color): void;

    public function getCreatedAt(): \DateTimeImmutable;

    public function setCreatedAt(\DateTimeImmutable $createdAt): void;

    public function getUpdatedAt(): \DateTimeImmutable;

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): void;

    public function getDeletedAt(): ?\DateTimeImmutable;

    public function setDeletedAt(?\DateTimeImmutable $deletedAt): void;
}
