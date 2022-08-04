<?php

declare(strict_types=1);

namespace Asgrim\SideEffect;

use Psr\Http\Message\ServerRequestInterface;

interface CanGetRequest
{
    public function getRequest(ServerRequestInterface $request): void;
}
