<?php

declare(strict_types=1);

namespace Muffler\Shared\Infrastructure\Controller;

use Muffler\Shared\Infrastructure\Bus\SynchronousBus;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

readonly class BaseController
{
    public function __construct(
        protected SynchronousBus $bus,
        protected SerializerInterface $serializer,
        protected ValidatorInterface $validator,
    ) {
    }

    protected function validateRequest($request, $requestDto, $validationGroups): mixed
    {
        $data = json_decode($request->getContent(), true);

        $dto = $this->serializer->denormalize(
            $data,
            $requestDto,
            null,
            [AbstractNormalizer::IGNORED_ATTRIBUTES => ['id']]
        );

        $errors = $this->validator->validate($dto, null, $validationGroups);

        if (count($errors) > 0) {
            throw new BadRequestHttpException();
        }

        return $dto;
    }
}
