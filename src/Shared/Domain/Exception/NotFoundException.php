<?php

namespace Muffler\Shared\Domain\Exception;

use DomainException;
use Symfony\Component\HttpFoundation\Response;

class NotFoundException extends DomainException implements ExceptionInterface
{
    /**
     * @param string $entityClass
     * @param string $identifier
     *
     * @return self
     */
    public static function withIdentifier(string $entityClass, string $identifier): self
    {
        return new self(
            sprintf('An instance of %s with id %s was not found.',
                $entityClass,
                $identifier
            ),
            Response::HTTP_NOT_FOUND
        );
    }
}
