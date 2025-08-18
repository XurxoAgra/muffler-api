<?php

namespace Muffler\Tests\common\Support\Builder\Vehicle;

use Carbon\Carbon;
use DateTimeImmutable;
use Muffler\Tests\common\Support\Builder\BuilderInterface;
use Muffler\Vehicle\Domain\Entity\Vehicle;
use Muffler\Vehicle\Domain\ValueObject\Chassis;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Faker\Factory;


final class VehicleBuilder implements BuilderInterface
{
    public function __construct(
        private UuidInterface $id,
        private string $brand,
        private string $model,
        private ?int $year,
        private ?Chassis $chassis,
        private ?string $color,
        private ?DateTimeImmutable $createdAt,
        private ?DateTimeImmutable $updatedAt,
        private ?DateTimeImmutable $deletedAt,
    ) {
    }

    public static function create(): BuilderInterface
    {
        $now = Carbon::today()->toDateTimeImmutable();

        return new self(
            Uuid::uuid4(),
            Factory::create('es_ES')->randomElement(['Seat']),
            Factory::create('es_ES')->randomElement(['Ibiza']),
            1999,
            new Chassis(
                VehicleBuilder::vinGenerator()
            ),
            Factory::create('es_ES')->randomElement(['Red', 'Green', 'Blue']),
            $now,
            $now,
            null,
        );
    }

    public function build(): Vehicle
    {
        return new Vehicle(
            $this->id,
            $this->brand,
            $this->model,
            $this->year,
            $this->chassis,
            $this->color,
            $this->createdAt,
            $this->updatedAt,
            $this->deletedAt,
        );
    }

    public static function vinGenerator(): string
    {
        $characters = 'ABCDEFGHJKLMNPRSTUVWXYZ0123456789'; // sin I, O, Q
        $vin = '';

        for ($i = 0; $i < 17; $i++) {
            $vin .= $characters[random_int(0, strlen($characters) - 1)];
        }

        return $vin;
    }
}
