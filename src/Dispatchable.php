<?php

declare(strict_types=1);

namespace Asgrim\SideEffect;

use Stringable;

interface Dispatchable extends Stringable
{
    public function __toString(): string;
}
