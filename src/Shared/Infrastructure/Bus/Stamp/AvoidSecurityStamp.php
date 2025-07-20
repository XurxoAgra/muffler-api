<?php

namespace Muffler\Shared\Infrastructure\Bus\Stamp;

use Symfony\Component\Messenger\Stamp\StampInterface;

class AvoidSecurityStamp implements StampInterface
{
    /**
     * @return bool
     */
    public function isSecurable(): bool
    {
        return false;
    }
}
