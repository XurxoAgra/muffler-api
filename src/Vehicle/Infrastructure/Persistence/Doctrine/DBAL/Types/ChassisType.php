<?php

namespace Muffler\Vehicle\Infrastructure\Persistence\Doctrine\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Muffler\Vehicle\Domain\ValueObject\Chassis;

class ChassisType extends StringType
{
    private CONST NAME = 'VEHICLE_CHASSIS';

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): mixed
    {
        if ($value === null) {
            return null;
        }

        if (!$value instanceof Chassis) {
            throw new \InvalidArgumentException('Expected Chassis instance.');
        }

        return $value->value();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Chassis
    {
        if ($value === null || $value instanceof Chassis) {
            return $value;
        }

        return new Chassis($value);
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
