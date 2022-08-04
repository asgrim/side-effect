<?php /** @noinspection DevelopmentDependenciesUsageInspection */

declare(strict_types=1);

use Asgrim\SideEffect\CanGetRequest;
use Asgrim\SideEffect\Dispatchable;
use Asgrim\SideEffect\Framework;
use GuzzleHttp\Psr7\ServerRequest;
use Psr\Http\Message\ServerRequestInterface;

require_once __DIR__ . '/vendor/autoload.php';

echo (new Framework(
    ServerRequest::fromGlobals(),
    [
        new class implements Dispatchable, CanGetRequest {
            private ServerRequestInterface $request;
            public function __toString() : string
            {
                return sprintf('<h1>Hello %s</h1>', $this->request->getQueryParams()['who'] ?? 'world');
            }

            public function getRequest(ServerRequestInterface $request) : void
            {
                $this->request = $request;
            }
        },
    ]
));
