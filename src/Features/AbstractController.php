<?php

declare(strict_types=1);

namespace Asgrim\SideEffect\Features;

use Asgrim\SideEffect\CanHaveRequestInjected;
use Asgrim\SideEffect\Dispatchable;
use Psr\Http\Message\ServerRequestInterface;

abstract class AbstractController implements Dispatchable, CanHaveRequestInjected
{
    public ServerRequestInterface $request;
}
