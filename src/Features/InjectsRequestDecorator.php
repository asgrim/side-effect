<?php

declare(strict_types=1);

namespace Asgrim\SideEffect\Features;

use Asgrim\SideEffect\Dispatchable;
use Asgrim\SideEffect\Framework;
use Psr\Http\Message\ServerRequestInterface;

final class InjectsRequestDecorator implements Dispatchable
{
    public function __construct(private Dispatchable $dispatchable)
    {
    }

    public function __toString() : string
    {
        if (property_exists($this->dispatchable, 'request')) {
            $this->dispatchable->request = Framework::$dumpingGround[ServerRequestInterface::class];
        }

        return '' . $this->dispatchable;
    }
}
