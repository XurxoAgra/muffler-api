<?php

declare(strict_types=1);

namespace Muffler\Shared\Domain\Validation;

interface ValidationConstraintsInterface
{
    public static function getConstraints(): array;
}
