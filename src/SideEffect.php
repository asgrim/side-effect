<?php

declare(strict_types=1);

namespace Asgrim\SideEffect;

use Asgrim\SideEffect\Features\WrapDispatchableInStuffAndDispatchIt;

final class SideEffect
{
    public function __construct(private Dispatchable $dispatchable)
    {
    }

    public function __toString(): string
    {
        return new WrapDispatchableInStuffAndDispatchIt($this->dispatchable) . '';
    }
}
