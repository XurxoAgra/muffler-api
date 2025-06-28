<?php

declare(strict_types=1);

namespace Muffler\Vehicle\Infrastructure\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity]
class Vehicle
{
    public function __construct(
        #[ORM\Id]
        #[ORM\Column(type: 'string', length: 36)]
        private string $id,
        #[ORM\Column(type: 'string')]
        private string $brand,
        #[ORM\Column(type: 'string')]
        private string $model,
        #[ORM\Column(type: 'integer', nullable: true)]
        private ?int $year,
        #[ORM\Column(type: 'string', unique: true, nullable: true)]
        private ?string $chassis,
        #[ORM\Column(type: 'string', nullable: true)]
        private ?string $color,
        #[ORM\Column(type: 'datetime_immutable')]
        private \DateTimeImmutable $createdAt,
        #[ORM\Column(type: 'datetime_immutable')]
        private \DateTimeImmutable $updatedAt,
        #[ORM\Column(type: 'datetime_immutable')]
        private ?\DateTimeImmutable $deletedAt,
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
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

    public function getChassis(): ?string
    {
        return $this->chassis;
    }

    public function setChassis(?string $chassis): void
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
