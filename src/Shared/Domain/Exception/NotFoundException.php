<?php

declare(strict_types=1);

namespace Muffler\Shared\Domain\Exception;

use Symfony\Component\HttpFoundation\Response;

class NotFoundException extends \DomainException implements ExceptionInterface
{
    public static function withIdentifier(string $entityClass, string $identifier): self
    {
        return new self(
            sprintf(
                'An instance of %s with id %s was not found.',
                $entityClass,
                $identifier
            ),
            Response::HTTP_NOT_FOUND
        );
    }
}
