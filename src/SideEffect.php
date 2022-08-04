<?php

declare(strict_types=1);

namespace Asgrim\SideEffect;

final class SideEffect
{
    public function __construct(private Dispatchable $dispatchable)
    {

    }
    public function __toString(): string
    {
        return Framework::someSecretMagicToMakeThingsTasty($this->dispatchable) . '';
    }
}
