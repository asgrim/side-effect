<?php

declare(strict_types=1);

namespace Asgrim\SideEffect\Features;

use Asgrim\SideEffect\Dispatchable;
use Psr\Http\Message\ServerRequestInterface;

abstract class AbstractController implements Dispatchable
{
    public ServerRequestInterface $request;
}
