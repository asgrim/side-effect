<?php

declare(strict_types=1);

namespace Asgrim\SideEffect\Features;

use Asgrim\SideEffect\CanGetRequest;
use Asgrim\SideEffect\Dispatchable;
use Psr\Http\Message\ServerRequestInterface;

abstract class AbstractController implements Dispatchable, CanGetRequest
{
    protected ServerRequestInterface $request;

    public function getRequest(ServerRequestInterface $request) : void
    {
        $this->request = $request;
    }
}
