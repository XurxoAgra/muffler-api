<?php

declare(strict_types=1);

namespace Muffler\Vehicle\Infrastructure\Validation\Constraints;

use Muffler\Shared\Domain\Validation\ValidationConstraintsInterface;
use Muffler\Shared\Infrastructure\Validation\Constraints\AbstractConstraints;

class VehicleConstraints extends AbstractConstraints implements ValidationConstraintsInterface
{
    public const POST_GROUP = 'vehicle:postValidation';
    public const PUT_GROUP = 'vehicle:putValidation';

    public const PERSIST_CONSTRAINTS = [
        self::POST_GROUP,
        self::PUT_GROUP,
    ];

    /**
     * @throws \Exception
     */
    public static function getConstraints(): array
    {
        return array_merge_recursive(
            self::getStringConstraints('brand', min: 1),
            self::getStringConstraints('model', min: 1),
        );
    }
}
