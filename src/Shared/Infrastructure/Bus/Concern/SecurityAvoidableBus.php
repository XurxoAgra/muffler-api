<?php

namespace Muffler\Shared\Infrastructure\Bus\Concern;

use Muffler\Shared\Infrastructure\Bus\Stamp\AvoidSecurityStamp;
use Symfony\Component\Messenger\Envelope;

trait SecurityAvoidableBus
{
    public function checkIsSecurable(Envelope $query): void
    {
        $message   = $query->getMessage();
        $stamps    = $query->all(AvoidSecurityStamp::class);
        $lastStamp = end($stamps);

        if ($lastStamp instanceof AvoidSecurityStamp) {
            $message->setSecurable($lastStamp->isSecurable());
        }
    }
}

