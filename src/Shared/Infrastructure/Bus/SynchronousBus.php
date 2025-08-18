<?php

namespace Muffler\Shared\Infrastructure\Bus;

use Muffler\Shared\Infrastructure\Bus\Concern\SecurityAvoidableBus;
use Muffler\Shared\Infrastructure\Bus\Stamp\AvoidSecurityStamp;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class SynchronousBus
{
    use HandleTrait;
    use SecurityAvoidableBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @param object|Envelope $message
     * @param array           $stamps
     *
     * @return mixed
     */
    public function dispatch(mixed $message, array $stamps = []): mixed
    {
        $message = $message instanceof Envelope ? $message->with(...$stamps) : new Envelope($message, $stamps);
        $this->checkIsSecurable($message);

        return $this->handle($message);
    }

    /**
     * @param mixed $message
     * @param array $stamps
     *
     * @return mixed
     */
    public function dispatchUnsecured(mixed $message, array $stamps = []): mixed
    {
        $stamps[] = new AvoidSecurityStamp();

        return $this->dispatch($message, $stamps);
    }
}
