<?php

declare(strict_types=1);

namespace Muffler\Vehicle\Domain\ValueObject;

final readonly class Chassis
{
    private const VIN_LENGTH = 17;
    private const INVALID_CHARS = ['I', 'O', 'Q'];

    public function __construct(
        private ?string $value,
    ) {
        $this->validate($value);
    }

    private function validate(string $value): void
    {
        if (self::VIN_LENGTH !== strlen($value)) {
            throw new \InvalidArgumentException('The VIN must be exactly 17 characters long.');
        }

        if (!preg_match('/^[A-HJ-NPR-Z0-9]{17}$/i', $value)) {
            throw new \InvalidArgumentException('VIN contains invalid characters.');
        }
    }

    public function toString(): string
    {
        return $this->value;
    }
}
