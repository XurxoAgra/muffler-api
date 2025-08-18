<?php

namespace Muffler\Tests\common\Support\Builder;

interface BuilderInterface
{
    public static function create(): self;

    public function build(): mixed;
}
