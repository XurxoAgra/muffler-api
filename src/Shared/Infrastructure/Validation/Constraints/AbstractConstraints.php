<?php

declare(strict_types=1);

namespace Muffler\Shared\Infrastructure\Validation\Constraints;

use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Validator\Constraints as Assert;

abstract class AbstractConstraints
{
    /**
     * Child class must declare constants POST_GROUP and PUT_GROUP.
     */
    public const POST_GROUP = null;
    public const PUT_GROUP = null;

    public static function getIdentifierConstraints(string $field, array $groups = [], bool $required = true): array
    {
        $constraints[$field] = [
            new Assert\Type([
                'groups' => $groups,
                'type' => UuidInterface::class,
            ]),
        ];

        if ($required) {
            $constraints[$field] = [...$constraints[$field],
                new Assert\NotNull([
                    'groups' => $groups,
                ]),
            ];
        }

        return $constraints;
    }

    /**
     * @throws \Exception
     */
    public static function getStringConstraints(string $fieldName, bool $allowNull = false, int $max = 255, int $min = 2, ?array $groups = null): array
    {
        if ($min > 0) {
            return [
                $fieldName => [
                    new Assert\NotBlank([
                        'allowNull' => $allowNull,
                        'groups' => $groups ?? [self::getPostGroup()],
                    ]),
                    new Assert\Length([
                        'min' => $min,
                        'max' => $max,
                        'groups' => $groups ?? [self::getPostGroup(), self::getPutGroup()],
                    ]),
                ],
            ];
        } else {
            return [
                $fieldName => [
                    new Assert\Length([
                        'min' => $min,
                        'max' => $max,
                        'groups' => $groups ?? [self::getPostGroup(), self::getPutGroup()],
                    ]),
                ],
            ];
        }
    }

    public static function getStringNotRequireConstraints(string $fieldName, int $max = 255, int $min = 2): array
    {
        return [
            $fieldName => [
                new Assert\AtLeastOneOf([
                    'constraints' => [
                        new Assert\Blank([
                            'groups' => [self::getPostGroup(), self::getPutGroup()],
                        ]),
                        new Assert\Length([
                            'min' => $min,
                            'max' => $max,
                            'groups' => [self::getPostGroup(), self::getPutGroup()],
                        ]),
                    ],
                ]),
            ],
        ];
    }

    /**
     * @throws \Exception
     */
    public static function getNumberRequiredConstraints(string $fieldName, bool $allowZero = false): array
    {
        $constraint = $allowZero ? Assert\PositiveOrZero::class : Assert\Positive::class;

        return [
            $fieldName => [
                new $constraint([
                    'groups' => [self::getPostGroup()],
                ]),
            ],
        ];
    }

    /**
     * @throws \Exception
     */
    private static function getPostGroup(): string
    {
        self::checkGroupConstants();

        return static::POST_GROUP;
    }

    /**
     * @throws \Exception
     */
    private static function getPutGroup(): string
    {
        self::checkGroupConstants();

        return static::PUT_GROUP;
    }

    /**
     * @throws \Exception
     */
    private static function checkGroupConstants(): void
    {
        $c = get_called_class();
        if (is_null($c::POST_GROUP)) {
            throw new \Exception('POST_GROUP not declared at child constraint class.');
        }
        if (is_null($c::PUT_GROUP)) {
            throw new \Exception('PUT_GROUP not declared at child constraint class.');
        }
    }
}
